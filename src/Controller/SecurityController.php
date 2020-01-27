<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Form\ChangepassType;
//entity
use App\Form\AccountRegisterType;
use App\Repository\UserRepository;
use App\Repository\ContactusRepository;
use Symfony\Component\HttpFoundation\Request;
//password encoder -> hash
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//repo
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error=$utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
        return $this->render('security/index2.html.twig', [
            'controller_name' => 'SecurityController',
            'errorMessage'=>$error,
            'last_username'=>$lastUsername
        ]);
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){
    }
    /**
     * @Route("/admin/account/create",name="security_create")
     */
    public function createAdmin(UserPasswordEncoderInterface $encoder,ObjectManager $em,Request $request)
    {
        $User = new User();
        $form = $this->createForm(AccountRegisterType::class, $User);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            //file upload
            $file = $request->files->get('account_register')['Image'];
            $uploads_directory = $this->getParameter('uploads_directory');
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename
            );
            //end of file upload
            $User->setImage($filename);
            $hash = $encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($hash);
            $em->persist($User);
            $em->flush();
            $this->addFlash('info',"Successfuly Added!");
            return $this->redirectToRoute('security_create');
        }   
        return $this->render("security/accountRegister.html.twig",[
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/admin/account", name="security_view")
     */
    public function view(UserRepository $repo){
        $repo= $repo->findAll();

        return $this->render("security/accountView.html.twig",[
            'account' => $repo
        ]);
    }
    /**
     * @Route("/admin/account/delete/{id}", name="security_delete")
     */
    public function delete(User $user,Request $request, ObjectManager $em){

        $form = $this->createFormBuilder($user)
        ->add('Submit',SubmitType::class)
        ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success',"Delete Successfully");
            return $this->redirectToRoute("security_view");
        }
        $error = $form->getErrors();
        return $this->render("security/accountDelete.html.twig",[
            'form' => $form->createView(),
            'formError' => $error,
            'user' => $user
        ]);
    }
    /**
     * @Route("/admin/account/edit/{id}", name="security_edit")
     */
    public function edit(User $User,ObjectManager $em,Request $request,UserPasswordEncoderInterface $encoder){
        $form = $this->createForm(User1Type::class, $User);
        
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            //file upload
            $file = $request->files->get('user1')['Image'];
            if(!$file)
            {
                if($form->isValid())
               {
                 $em->flush();
                 $this->addFlash('info',"Edit Successfuly");
                 return $this->redirectToRoute('security_edit',['id'=> $User->getId()]);
               }else{
                $this->addFlash('info', $form->getErrors());
                return $this->redirectToRoute('security_edit',['id'=> $User->getId()]);
               } 
            }else{
                $uploads_directory = $this->getParameter('uploads_directory');
                $filename = md5(uniqid()) . '.' . $file->guessExtension();
                  $file->move(
                  $uploads_directory,
                  $filename
                 );
                 $User->setImage($filename);
                 if($form->isValid())
               {
                 $em->flush();
                 $this->addFlash('info',"Edit Successfuly");
                 return $this->redirectToRoute('security_edit',['id'=> $User->getId()]);
               }
            }   
        }
        $image = $User->getImage();
        $UserId = $User->getId();
        return $this->render("security/accountEdit.html.twig",[
            'form' => $form->createView(),
            'image' => $image,
            'UserId' => $UserId
        ]);
    }
    /**
     * @Route("admin/dashboard",name="security_dashboard")
     */
    public function adminDashboard(ContactusRepository $Contactrepo)
    {
        //repo
        $Contactrepo = $Contactrepo->findAll();

        $user = new User();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        //session
        $session = new Session();
        $session->set('nameMoto', $Contactrepo);

        return $this->render('security/dashboard.html.twig',[
            'user' => $user
        ]);
    }
    /**
     * @Route("admin/account/changepassword/{id}", name="account_changepassword")
     */
    public function changePassword(User $User,Request $request,ObjectManager $em,UserPasswordEncoderInterface $encoder)
    {
        $form = $this->createForm(ChangepassType::class, $User);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {   
            //set password hash
            $hash = $encoder->encodePassword($User, $form->getData()->getPassword());
            $User->setPassword($hash);
            $em->flush();
            $this->addFlash('info', "Edit Successfuly");
            return $this->redirectToRoute('security_edit',['id' => $User->getId()]);
        }

        return $this->render("security/accountChangepassword.html.twig",[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("admin/account/detail/{id}", name="security_detail")
     */
    public function detail(User $User)
    {
        return $this->render("security/accountDetail.html.twig",[
            "User" => $User
        ]);
    }
}
