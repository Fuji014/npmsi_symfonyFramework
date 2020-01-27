<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use 
use App\Repository\ShipticketRepository;
use App\Entity\Shipticket;
use App\Form\ShipticketType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ShipticketController extends AbstractController
{
    /**
     * @Route("/admin/shipticket/create", name="shipticket_create")
     */
    public function create(Request $request, ObjectManager $em)
    {
        $Shipticket = new Shipticket();
        $form = $this->createForm(ShipticketType::class, $Shipticket);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($Shipticket);
            $em->flush();
            $this->addFlash("success","Added Successfuly");
            return $this->redirectToRoute('shipticket_create');

        }
        return $this->render('security/shipticketCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/shipticket/edit/{id}", name="shipticket_edit")
     */
    public function edit(Shipticket $shipticket,Request $request,ObjectManager $em)
    {
        $form = $this->createForm(ShipticketType::class, $shipticket);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash("success", "Edit Successfuly");
            return $this->redirectToRoute('shipticket_edit',['id' => $shipticket->getId()]);

        }
        
        return $this->render("security/shipticketEdit.html.twig",[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/shipticket", name="shipticket_view")
     */
    public function view(ShipticketRepository $repo,ObjectManager $em){
        $repo = $repo->findAll();
        return $this->render("security/shipticketView.html.twig",[
            'shipticket' => $repo
        ]);
    }
    /**
     * @Route("/admin/shipticket/delete/{id}", name="shipticket_delete")
     * @Method({"DELETE"})
     */
    public function delete(Shipticket $Shipticket,ShipticketRepository $repo,ObjectManager $em)
    {
        $repo = $repo->find($Shipticket);
        $em->remove($repo);
        $em->flush();
        return new Response();
    }
    
}
