<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use
//use 
use App\Repository\ShipscheduleRepository;
use App\Entity\Shipschedule;
use App\Form\ShipscheduleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ShipscheduleController extends AbstractController
{
    /**
     * @Route("admin/shipschedule/create", name="shipschedule_create")
     */
    public function create(Request $request,ObjectManager $em)
    {
        $Shipschedule = new Shipschedule();
        $form = $this->createForm(ShipscheduleType::class, $Shipschedule);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($Shipschedule);
            $em->flush();
            $this->addFlash('success', "Added Successfuly!");
            return $this->redirectToRoute('shipschedule_create');
        }
        return $this->render('security/shipscheduleCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("admin/shipschedule/edit/{id}", name="shipschedule_edit")
     */
    public function edit(Shipschedule $Shipschedule,ObjectManager $em,Request $request)
    {
        $form = $this->createForm(ShipscheduleType::class, $Shipschedule);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('success',"Edit Successfuly");
            return $this->redirectToRoute('shipschedule_edit',['id' => $Shipschedule->getId()]);
        }
        return $this->render("security/shipscheduleEdit.html.twig",[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("admin/shipschedule", name="shipschedule_view")
     */
    public function view(ShipscheduleRepository $repo,ObjectManager $em){
        $repo = $repo->findAll();
        return $this->render("security/shipscheduleView.html.twig",[
            'shipschedule' => $repo
        ]);
    }
    /**
     * @Route("admin/shipschedule/delete/{id}", name="shipschedule_delete")
     * @Method({"DELETE"})
     */
    public function delete(Shipschedule $Shipschedule,ShipscheduleRepository $repo,ObjectManager $em)
    {
        $repo = $repo->find($Shipschedule);
        $em->remove($repo);
        $em->flush();
        return new Response();
    }
}
