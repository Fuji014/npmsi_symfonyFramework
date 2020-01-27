<?php

namespace App\Controller;

use App\Entity\Email;
use App\Form\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    /**
     * @Route("admin/email/create", name="email_create")
     */
    public function index(ObjectManager $em,Request $request, \Swift_Mailer $mailer)
    {
        $Email = new Email();
        $form = $this->createForm(EmailType::class, $Email);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            //variables
            $subject = $form->getData()->getSubject(); 
            $to = $form->getData()->getGmailto();
            $username = 'fujiapple10101@gmail.com';
            $body = $form->getData()->getBody();
            //swift
            $message = (new \Swift_Message('Hello Email'))
            ->setContentType('text/html')
            ->setSubject($subject)
            ->setFrom($username)
            ->setTo($to)
            ->setBody($body);
            $mailer->send($message); //if object not send status DRAFT and if send status SENT
            //end swift
            //set unset var
            $Email->setGmailfrom($username);
            $Email->setCreatedAt(new \DateTime());
            $Email->setStatus('Sent'); //pansamantagal identical sent or draft
            //end set var
            $em->persist($Email);
            $em->flush();

            $this->addFlash('info', 'Email sent successfully!');
            return $this->redirectToRoute('email_create');
        }

        return $this->render('security/emailCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
