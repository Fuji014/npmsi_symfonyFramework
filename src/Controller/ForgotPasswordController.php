<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Form\ConfirmPasswordType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ForgotPasswordController extends AbstractController
{
    /**
     * @Route("/forgot/email", name="forgot_email")
     */
    public function email(Request $request,UserRepository $repo,ObjectManager $em)
    {
        $user = new User();
        $defaultdata = ['message'=>'npmsi data message'];
        $form =$this->createForm(ForgotPasswordType::class, $defaultdata,['data_class'=>null]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $submittedEmail = $form->getData();
            $compareEmail = $repo->findOneBy(['Email'=>$submittedEmail['Email']]);
            if($compareEmail){
                $token = md5(uniqid());
                $user->setToken($token);
                $em->flush();
            }else{
                echo 'account not found';
            }
         }
        $errorMessage = $form->getErrors();
        return $this->render('forgot_password/emailForgotPassword.html.twig',[
            'errorMessage' => $errorMessage,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/forgot/newpassword", name="forgot_newpassword")
     */
    public function newPassword(Request $request,UserPasswordEncoderInterface $encoder,ObjectManager $em){
        $User = new User();
        $form = $this->createForm(ConfirmPasswordType::class, $User);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {   
            //set password hash
            $hash = $encoder->encodePassword($User, $form->getData()->getPassword());
            $User->setPassword($hash);
            $em->flush();
        }

        return $this->render("forgot_password/confirmPassword.html.twig",[
            'form'=>$form->createView()
        ]);
    }
}
