<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleType;
use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleController extends AbstractController
{
   
    /**
     * @Route("/admin/article/create", name="article_create")
     */
    public function create(ObjectManager $em,Request $request)
    {
        $Article = new Article();
        $form = $this->createForm(ArticleType::class, $Article);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                //file upload
                $file = $request->files->get('article')['image'];
                $uploads_directory = $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $uploads_directory,
                    $filename
                );
                //end of file upload
                $Article->setImage($filename);
                $Article->setCreatedAt(new \DateTime());
                $em->persist($Article);
                $em->flush();
                $this->addFlash('success',"Successfuly Added!");
                return $this->redirectToRoute('article_create');
        }
        return $this->render('security/articleCreate.html.twig', [
            'controller_name' => 'ArticleController',
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/admin/article/edit/{id}", name="article_edit")
     */
    public function edit(Article $Article,Request $request,ObjectManager $em){
        $form = $this->createForm(ArticleType::class, $Article);
        $image = $Article->getImage();
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
                //file upload
                $file = $request->files->get('article')['image'];
                if(!$file)
                {
                    if($form->isValid())
                   {
                     $em->flush();
                     $this->addFlash('success',"Edit Successfuly");
                     return $this->redirectToRoute('article_edit',['id'=> $Article->getId()]);
                   }  
                }else{
                    $uploads_directory = $this->getParameter('uploads_directory');
                    $filename = md5(uniqid()) . '.' . $file->guessExtension();
                      $file->move(
                      $uploads_directory,
                      $filename
                     );
                     $Article->setImage($filename);
                     if($form->isValid())
                   {
                     $em->flush();
                     $this->addFlash('success',"Edit Successfuly");
                     return $this->redirectToRoute('article_edit',['id'=> $Article->getId()]);
                   } 

                }
                
                        
        }
        
        return $this->render("security/articleEdit.html.twig",[
            'form' => $form->createView(),
            'image' => $image
        ]);
    }
    /**
     * @Route("admin/article", name="article_table")
     */
    public function view(ArticleRepository $repo)
    {
        $repo = $repo->findAll();
       

        return $this->render("security/articleView.html.twig",[
            'articles'=>$repo
        ]);
    }
    /**
     * @Route("admin/article/details/{id}", name="article_details")
     */
    public function details(Article $articles)
    {
        return $this->render('security/articleDetails.html.twig', [
            'article' => $articles
        ]);
    }
    /**
     * @Route("admin/article/delete/{id}", name="aticle_delete")
     * @Method({"DELETE"})
     */
    public function delete($id,ObjectManager $em){
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
        $em->remove($article);
        $em->flush();
        return new Response();
    }
    /**
     * @Route("admin/article/deleteSample/{id}", name="article_SampleDelete")
     */
    public function deleteSample(Article $articles,ObjectManager $em,Request $request)
    {
        $form = $this->createFormBuilder($articles)
        ->add('Submit',SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->remove($articles);
            $em->flush();
            $this->addFlash('success',"Delete Successfully");
            return $this->redirectToRoute("article_table");
        }
        
        $error=$form->getErrors();
        return $this->render("security/articleDelete.html.twig",[
            'article' => $articles,
            'form' => $form->createView(),
            'formError' => $error
        ]);
    }
}
