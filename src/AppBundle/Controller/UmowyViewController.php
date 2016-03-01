<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UmowyViewController extends Controller
{
    /**
     * @Route("/view", name="view_umowy")
     */
    public function ViewAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $umowy_repo = $em->getRepository('AppBundle:Umowa');

        $umowy = $umowy_repo->findAll();

        return $this->render('user/view_umowy.html.twig', array(
            'umowy'=>$umowy,
        ));
    }
}
