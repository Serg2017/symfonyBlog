<?php
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SiteController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function indexAction()
    {
        $title = 'Main Page';
        $content = "Main Page Text";

        return $this->render('BlogBundle:Site:index.html.twig', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * @Route("/abouts", name="abouts")
     */
    public function aboutAsAction()
    {
        $title = 'Abouts';
        $content = "Abouts Text";

        return $this->render('BlogBundle:Site:aboutAs.html.twig', [
            'title' => $title,
            'content' => $content,
        ]);
    }
}