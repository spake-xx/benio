<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Umowa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin/umowy/dodaj/", name="umowa_admin")
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
     * @Route("/admin/umowy/", name="admin_umowy_pokaz")
     */
    function ShowUmowyAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Umowa');
        $qb = $repo->createQueryBuilder('u');
        $query = $qb->getQuery();

        $paginator = $this->get('knp_paginator');
        $umowy = $paginator->paginate(
          $query,
          $request->query->getInt('page', 1)
        );

        return $this->render('admin/umowy.html.twig', array(
            'umowy'=>$umowy,
        ));
    }

    /**
     * @Route("/admin/umowa/remove/{id}/", name="admin_umowa_usun")
     */
    function UsunUmowaAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Umowa');
        $umowa = $repo->find($id);
        $em->remove($umowa);
        $em->flush();

        return $this->redirectToRoute('admin_umowy_pokaz');
    }

    /**
     * @Route("/admin/umowa/edit/{id}/", name="admin_umowa_edytuj")
     */
    function EdytujUmowaAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Umowa');
        $umowa = $repo->find($id);

        $form = $this->createFormBuilder($umowa)
                    ->add('podmiot')
                    ->add('zadanie')
                    ->add('pkd')
                    ->add('uwagi')
                    ->add('kwota')
                    ->add('samorzad', EntityType::class, array(
                        'class'=>'AppBundle:Samorzad',
                        'choice_label'=>'samorzad'
                    ))
                    ->add('save', SubmitType::class)
                    ->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $this->addFlash('notice', "Pomyślnie zaktualizowano umowę.");
            $em->flush();
        }

        return $this->render('admin/umowa_edit.html.twig', array(
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
