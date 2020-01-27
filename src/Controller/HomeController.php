<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
//repos
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\ShiptypeRepository;
use App\Repository\ShipticketRepository;
use App\Repository\ShipscheduleRepository;

//entity
use App\Entity\Article;
use App\Entity\Contactus;
use App\Entity\Comment;
//form
use App\Form\ContactusType;
use App\Form\CommentType;
//others
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_show")
     */
    public function show(ShipscheduleRepository $repoShipschedule,ShipticketRepository $repoShipticket,ArticleRepository $repoArticle, CategoryRepository $repoCategory,Request $request, ObjectManager $em)
    {
        //creating form for contact us
        $ContactUs = new Contactus();
        $formContactUs = $this->createForm(ContactusType::class, $ContactUs);
        $formContactUs->handleRequest($request);
        if($formContactUs->isSubmitted() && $formContactUs->isValid())
        {
            $ContactUs->setCreatedAt(new \DateTime());
            $ContactUs->setStatus("Unread");
            $em->persist($ContactUs);
            $em->flush();
            $this->addFlash('info', "Message Sent! Thankyou for reaching us");
            return $this->redirectToRoute("home_show");
        }

        //repos
        $repoCategorySlideshow = $repoArticle->findBy(['category'=>6]);
        $repoCategoryServices = $repoArticle->findBy(['category'=>9]);
        $repoCategoryAboutUs = $repoArticle->findOneBy(['category'=>5]);
        $repoCategoryDestination = $repoArticle->findBy(['category'=>10]);
        $repoCategoryBlog = $repoArticle->findBy(['category'=>4]);
        $repoShipticket = $repoShipticket->findAll();
        $repoShipschedule = $repoShipschedule->findAll();

        //testing purposes
        // dump($repoCategoryBlog);
        $repoArticle = $repoArticle->findAll();
        return $this->render('home/index.html.twig', [
            'SlideShow' => $repoCategorySlideshow,
            'Services' => $repoCategoryServices,
            'AboutUs' => $repoCategoryAboutUs,
            'Destination' => $repoCategoryDestination,
            'ShipTicket' => $repoShipticket,
            'ShipSchedule' => $repoShipschedule,
            'Blog' => $repoCategoryBlog,
            'Articles'=>$repoArticle,
            'formContactUs' => $formContactUs->createView()
        ]);
    }
    /**
     * @Route("/blog/{id}", name="home_blog")
     */
    public function blog(Article $article,Request $request,ObjectManager $em,ArticleRepository $repoBlog)
    {
        $Comment = new Comment();
        $form = $this->createForm(CommentType::class, $Comment);
        $form->handleRequest($request);
        $repoBlogAll = $repoBlog->findBy(['category' => 4]);
        if($form->isSubmitted() && $form->isValid())
        {
            $Comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);
            $em->persist($Comment);
            $em->flush();
            $this->addFlash('info', "Message Sent!");
            return $this->redirectToRoute('home_blog',['id'=>$article->getId()]);

        }
        return $this->render("home/blogSingle.html.twig",[
            'article' => $article,
            'form' => $form->createView(),
            'BlogRecent' => $repoBlogAll
        ]);
    }
}
