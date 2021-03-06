<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blog")
     */
    public function indexAction(Request $request)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $blogRepository = $em->getRepository('BlogBundle:Blog');
        $blogs = $blogRepository->findAll();
        //KNP Pagination
        $paginator  = $this->get('knp_paginator');
        $blogPagination = $paginator->paginate(
            $blogs,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4)
        );

        return $this->render('BlogBundle:Blog:index.html.twig', [
            'blogPagination' => $blogPagination,
        ]);
    }

    /**
     * @Route("/blog/{id}", name="blogView",
     *     requirements = {"id" : "\d+"}
     *     )
     */
    public function blogViewAction($id)
    {
        //$em = $this->getDoctrine();
        $em = $this->get('doctrine.orm.default_entity_manager');
        $blogRepository = $em->getRepository('BlogBundle:Blog');
        $blog = $blogRepository->find($id);

        return $this->render('BlogBundle:Blog:view.html.twig', [
            'blog' => $blog,
        ]);
    }
}


































