<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/admin/message/create", name="message_create")
     */
    public function index(ObjectManager $em,Request $request)
    {
        $Message = new Message();
        $form = $this->createForm(MessageType::class, $Message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

         //##########################################################################
            function itexmo($number,$message,$apicode){
            $url = 'https://www.itexmo.com/php_api/api.php';
            $itexmo = array('number' => $number, 'message' => $message, 'apicode' => $apicode);
            $param = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($itexmo),
                ),
            );
            $context  = stream_context_create($param);
            return file_get_contents($url, false, $context);}
            //##########################################################################
            //setting up variables
            $number=$form->getData()->getCellnumber();
            $message1=$form->getData()->getNumber();
            $message2=$form->getData()->getMessage();
            $message = $message1. ' '.$message2;
            $apicode="TR-APPLE118184_FCB5S";
            ##########################################################################
            $result = itexmo($number,$message,$apicode);
            if ($result == ""){
            $noRes= "iTexMo: No response from server!!!";	
            $this->addFlash('success',$noRes);
            }else if ($result == 0){
            $sent= "Message Sent!";
            $this->addFlash('success',$sent);
            $Message->setStatus("Sent");
            }
            else{	
            $Message->setStatus("Not Sent");
            $err= "Error in ". $result . " was encountered!";
            $this->addFlash('success', $err);
            }

            $Message->setCreatedAt(new \DateTime());
            
            $em->persist($Message);
            $em->flush();
            return $this->redirectToRoute('message_create');
        }

        return $this->render('security/messageCreate.html.twig', [
            'controller_name' => 'MessageController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/message", name="message_view")
     */
    public function view(MessageRepository $repo)
    {
        $repo = $repo->findAll();

        return $this->render("security/messageView.html.twig",[
            'message'=>$repo
        ]);

    }
    /**
     * @Route("/admin/message/edit/{id}", name="message_edit")
     */
    public function edit(Message $message,Request $request,ObjectManager $em)
    {
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

             //##########################################################################
             function itexmo($number,$message,$apicode){
                $url = 'https://www.itexmo.com/php_api/api.php';
                $itexmo = array('number' => $number, 'message' => $message, 'apicode' => $apicode);
                $param = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($itexmo),
                    ),
                );
                $context  = stream_context_create($param);
                return file_get_contents($url, false, $context);}
                //##########################################################################
                //setting up variables
                $number=$form->getData()->getCellnumber();
                $message1=$form->getData()->getNumber();
                $message2=$form->getData()->getMessage();
                $message = $message1. ' '.$message2;
                $apicode="TR-APPLE118184_FCB5S";
                ##########################################################################
                $result = itexmo($number,$message,$apicode);
                if ($result == ""){
                $noRes= "iTexMo: No response from server!!!";	
                $this->addFlash('success',$noRes);
                }else if ($result == 0){
                $sent= "Message Sent!";
                $this->addFlash('success',$sent);
                }
                else{	
                $err= "Error in ". $result . " was encountered!";
                $this->addFlash('success', $err);
                }
            $em->flush();
            
        }
        return $this->render("security/messageEdit.html.twig",[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("message/delete/{id}",name="message_delete")
     */
    public function delete(Message $message,ObjectManager $em, Request $request)
    {
        $form = $this->createFormBuilder($message)
        ->add('Submit',SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->remove($message);
            $em->flush();
            $this->addFlash('success', "Delete Successfully");
            return $this->redirectToRoute("message_view");
        }
        $error = $form->getErrors();
        return $this->render("security/messageDelete.html.twig",[
            'form' => $form->createView(),
            'message' => $message,
            'formError' => $error
        ]);
    }
}
