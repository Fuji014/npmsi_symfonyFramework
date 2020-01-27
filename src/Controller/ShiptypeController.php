<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use 
use App\Repository\ShiptypeRepository;
use App\Entity\Shiptype;
use App\Form\ShiptypeType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;


class ShiptypeController extends AbstractController
{
    /**
     * @Route("/admin/shiptype/create", name="shiptype_create")
     */
    public function create(Request $request,ObjectManager $em)
    {
        $Shiptype = new Shiptype();
        $form = $this->createForm(ShiptypeType::class, $Shiptype);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //file upload
            $file = $request->files->get('shiptype')['Image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            $Shiptype->setShipimage($filename);
            $em->persist($Shiptype);
            $em->flush();
            $this->addFlash('success',"Added Successfuly!");
            return $this->redirectToRoute('shiptype_create');
        }
        return $this->render('security/shiptypeCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/shiptype/edit/{id}", name="shiptype_edit")
     */
    public function edit(Shiptype $Shiptype,Request $request,ObjectManager $em)
    {
        $form = $this->createForm(ShiptypeType::class, $Shiptype);
        $form->handleRequest($request);
        $getImage = $Shiptype->getShipimage();
        if($form->isSubmitted())
        {
            $file = $request->files->get('shiptype')['Image'];
            if(!$file)
            {
                    if($form->isValid())
                {
                    $em->flush();
                    $this->addFlash('success', "Edit Successfuly");
                    return $this->redirectToRoute('shiptype_edit',['id' => $Shiptype->getId()]);
                }
            }
            else{
                //file upload
                $file = $request->files->get('shiptype')['Image'];
                $uploads_directory = $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move(
                    $uploads_directory,
                    $filename
                );
                $Shiptype->setShipimage($filename);
                if($form->isValid())
                {
                    $em->flush();
                    $this->addFlash('success', "Edit Successfuly");
                    return $this->redirectToRoute('shiptype_edit',['id' => $Shiptype->getId()]);
                }
            }
        }
        return $this->render("security/shiptypeEdit.html.twig",[
            'form' => $form->createView(),
            'image' => $getImage
        ]);

    }
    /**
     * @Route("/admin/shiptype", name="shiptype_view")
     */
    public function view(ShiptypeRepository $repo)
    {
        $repo = $repo->findAll();

        return $this->render("security/shiptypeView.html.twig",[
            'shiptype' => $repo
        ]);
    }
    /**
     * @Route("/admin/shiptype/delete/{id}", name="shiptype_delete")
     * @Method({"DELETE"})
     */
    public function delete(Shiptype $Shiptype,ShiptypeRepository $repo,ObjectManager $em)
    {
        $repo = $repo->find($Shiptype);
        $em->remove($repo);
        $em->flush();
        return new Response();
    }
}
