<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="category_view")
     */
    public function view(CategoryRepository $repo)
    {
        $repo = $repo->findAll();

        return $this->render('security/categoryView.html.twig', [
            'category' => $repo,
        ]);
    }
    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function create(Request $request,ObjectManager $em)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($category);
            $em->flush();
            $this->addFlash('success', 'Added Successfuly!');
            return $this->redirectToRoute('category_create');
        }
        return $this->render("security/categoryCreate.html.twig",[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/category/edit/{id}", name="category_edit")
     */
    public function edit(Category $category,ObjectManager $em,Request $request)
    {
        $form= $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('success',"Edit Successfuly!");
            return $this->redirectToRoute('category_edit',['id'=>$category->getId()]);
        }
        return $this->render("security/categoryEdit.html.twig",[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/admin/category/delete/{id}", name="category_delete")
     */
    public function delete(Category $category,ObjectManager $em,Request $request)
    {
        $form = $this->createFormBuilder($category)
        ->add('Submit',SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->remove($category);
            $em->flush();
            $this->addFlash('success', "Delete Successfully");
            return $this->redirectToRoute("category_view");
        }
        $error = $form->getErrors();
        return $this->render("security/categoryDelete.html.twig",[
            'form' => $form->createView(),
            'category' => $category,
            'formError' => $error
        ]);
    }
}
