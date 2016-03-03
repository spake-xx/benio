<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;

class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $samorzad = $user->getSamorzad();
        $repo = $em->getRepository('AppBundle:Umowa');
        $qb = $repo->createQueryBuilder('u');
        $query = $qb->where('u.samorzad='.$samorzad->getKod())->setMaxgetQuery();
        $umowy = $query->getResult();


        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }



        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
            'user' => $user,
            'umowy' => 'hehe'
        ));
    }

}
