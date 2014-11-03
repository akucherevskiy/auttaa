<?php

namespace Auttaa\WebBundle\Controller;

use Auttaa\WebBundle\Entity\User;
use Auttaa\WebBundle\Form\SubscribeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new SubscribeType(), $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $user->setUsername($user->getEmail().time());
            $user_password_salt = '1232hesfls;dfok23';
            $user->setPassword($user->getEmail() . $user_password_salt);
            $em->persist($user);
            $em->flush();

            $session = $this->getRequest()->getSession();
            $session->getFlashBag()->add('message', 'Article saved!');

            return $this->render('AuttaaWebBundle:Index:index.html.twig', array('form' => $form->createView(), 'saved' => 1));
        }

        return $this->render('AuttaaWebBundle:Index:index.html.twig', array('form' => $form->createView(), 'saved' => 0));
    }


    /**
     * @Route('/subscribe/{email}')
     */
    public function subscribeAction(){
    }
}
