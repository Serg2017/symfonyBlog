<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Form\Type\BlogFormType;

class AdminController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        exit();
        return $this->render();
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction()
    {
        $title = 'MainAdmin';
        $content = 'Hello in Main Page Admin';

        return $this->render('BlogBundle:Admin:index.html.twig', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    /**
     * @Route("/admin/blogs", name="adminBlogs")
     */
    public function blogAction()
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $blogRepository = $em->getRepository('BlogBundle:Blog');
        $blogs = $blogRepository->findAllBlog();

        return $this->render('BlogBundle:Admin:blog.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * @Route("blog/add", name="adminBlogAdd")
     */
    public function blogAddAction(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm(BlogFormType::class, $blog);

        $form->handleRequest($request);
        if($request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                $em = $this->get('doctrine.orm.default_entity_manager');
                $em->persist($blog);
                $em->flush($blog);

                return $this->redirectToRoute('adminBlogs');
            }
        }

        return $this->render('BlogBundle:Admin:blog_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/blog/{id}/edit", name="adminBlogEdit")
     */
    public function blogEditAction(Request $request, $id)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $blog = $em->getRepository('BlogBundle:Blog')->find($id);
        if(!$blog) {
            throw $this->createAccessDeniedException('You cannot access this page!');
        }

        $form = $this->createForm(BlogFormType::class, $blog);

        $form->handleRequest($request);
        if($request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                $em->persist($blog);
                $em->flush($blog);

                return $this->redirectToRoute('adminBlogs');
            }
        }

        return $this->render('BlogBundle:Admin:blog_add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/blog/{id}/delete", name="adminBlogDelete")
     */
    public function blogDeleteAction($id)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $company = $em->getRepository('BlogBundle:Blog')->find($id);
        $em->remove($company);
        $em->flush();

        return $this->redirectToRoute('adminBlogs');
    }
}