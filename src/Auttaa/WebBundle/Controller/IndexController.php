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

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $session = $this->getRequest()->getSession();
            $session->getFlashBag()->add('message', 'Article saved!');

            return $this->redirect($this->generateUrl('/'));
        }

        return $this->render('AuttaaWebBundle:Index:index.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route('/subscribe/{email}')
     */
    public function subscribeAction(){
    }
}
