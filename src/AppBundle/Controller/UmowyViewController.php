<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UmowyViewController extends Controller
{
    /**
     * @Route("/umowy/all/", name="view_wszystkie")
     */
    public function wszystkieUmowyAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $umowy_repo = $em->getRepository('AppBundle:Umowa');
        $qb = $umowy_repo->createQueryBuilder('u');
        $qb->innerJoin('u.samorzad', 's');
        $query = $qb->getQuery();

        $paginator  = $this->get('knp_paginator');
        $umowy = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            50
        );
        return $this->render('default/view_umowy_all.html.twig', array(
            'umowy'=>$umowy,
        ));
    }

    /**
     * @Route("/umowy/", name="view_moje")
     */
    public function mojeUmowyAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $umowy_repo = $em->getRepository('AppBundle:Umowa');

//        $umowy = $umowy_repo->findBySamorzad($user->getSamorzad());
        $qb = $umowy_repo->createQueryBuilder('u');
        $query = $qb->where('u.samorzad='.$user->getSamorzad()->getKod())->getQuery();


        $paginator = $this->get('knp_paginator');
        $umowy = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            50
        );

        return $this->render('user/view_umowy.html.twig', array(
            'umowy'=>$umowy,
        ));
    }
}
