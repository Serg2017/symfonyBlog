<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\User;
use BlogBundle\Form\Type\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginControllerController extends Controller
{
    /**
     * @Route("/register")
     */
    public function registerAction(Request $request/*, UserPasswordEncoderInterface $encoder*/)
    {
        $em = $this->get('doctrine.orm.default_entity_manager');
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        if($request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                //Encode Password
                /*$user->setPassword($encoder->encodePassword($user, $user->getPassword()));*/
                $em->persist($user);
                $em->flush($user);

                return $this->redirectToRoute('login');
            }
        }

        return $this->render('BlogBundle:Login:register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);

        return $this->render('BlogBundle:Login:login.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
