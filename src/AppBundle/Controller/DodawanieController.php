<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Umowa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DodawanieController extends Controller
{
    /**
     * @Route("/admin/umowy/dodaj", name="umowa_admin")
     */
    function NowaUmowaAdminAction(Request $request){
        $umowa = new Umowa();
        $em = $this->getDoctrine()->getManager();

        $form = $this->getAddForm($umowa, true);

        $form->handleRequest($request);

        if($form->isValid()){
            $em->persist($umowa);
            $em->flush();
            $samorzad = $umowa->getSamorzad();
            unset($umowa);
            $umowa = new Umowa();
            $umowa->setSamorzad($samorzad);
            unset($form);
            $form = $this->getAddForm($umowa);

            $this->addFlash('notice', 'Pomyślnie dodano umowę do bazy danych');
        }

        return $this->render('admin/add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    /**
     * @Route("/umowy/dodaj", name="umowa_gmina")
     */
    function NowaUmowaGminaAction(Request $request){
        $umowa = new Umowa();
        $umowa->setSamorzad($this->getUser()->getSamorzad());
        $em = $this->getDoctrine()->getManager();

        $form = $this->getAddForm($umowa, false);

        $form->handleRequest($request);

        if($form->isValid()) {
            $em->persist($umowa);
            $em->flush();
            $this->addFlash('notice', 'Pomyślnie dodano umowę do bazy danych');

        }

        return $this->render('user/add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    function getAddForm($umowa, $admin){
        $form = $this->createFormBuilder($umowa)
            ->add('podmiot')
            ->add('zadanie')
            ->add('kwota')
            ->add('pkd')
            ->add('uwagi')
            ->add('Zapisz i wyślij', SubmitType::class)
            ->getForm();

        if($admin){
            $form->add('samorzad', EntityType::class, array(
                'class' => 'AppBundle:Samorzad',
                'choice_label' => 'samorzad',
            ));
        }

        return $form;
    }
}
