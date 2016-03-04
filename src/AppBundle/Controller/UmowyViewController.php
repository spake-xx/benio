<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UmowyViewController extends Controller
{
    /**
     * @Route("/umowy/all", name="view_wszystkie")
     */
    public function wszystkieUmowyAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $umowy_repo = $em->getRepository('AppBundle:Umowa');
        $qb = $umowy_repo->createQueryBuilder('u');
        $query = $qb->getQuery();

        $paginator  = $this->get('knp_paginator');
//        $umowy = $umowy_repo->findAll();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('user/view_umowy.html.twig', array(
//            'umowy'=>$umowy,
            'pagination'=>$pagination,
        ));
    }

    /**
     * @Route("/umowy", name="view_moje")
     */
    public function mojeUmowyAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $umowy_repo = $em->getRepository('AppBundle:Umowa');

        $umowy = $umowy_repo->findBySamorzad($user->getSamorzad());

        return $this->render('user/view_umowy.html.twig', array(
            'umowy'=>$umowy,
        ));
    }
}
