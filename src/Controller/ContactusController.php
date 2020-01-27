<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//use 
use App\Repository\ContactusRepository;
use App\Entity\Contactus;
use App\Form\ContactusType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ContactusController extends AbstractController
{
    /**
     * @Route("admin/contactus", name="contactus_view")
     */
    public function view(ContactusRepository $repo)
    {
        $repo = $repo->findAll();
        return $this->render('security/contactusView.html.twig', [
            'ContactUsMessage' => $repo
        ]);
    }
}
