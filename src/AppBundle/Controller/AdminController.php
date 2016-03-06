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
     * @Route("/admin/", name="admin_index")
     */
    function adminIndexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('UserBundle:User');
        $qb = $repo->createQueryBuilder('u');
        $query = $qb->where('u.enabled=0')->getQuery();
        $users = $query->getResult();

        return $this->render('admin/index.html.twig', array(
            'users'=>$users,
        ));
    }

    /**
     * @Route("/admin/users", name="admin_users")
     */
    function AdminUsersAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('UserBundle:User');
        $qb = $repo->createQueryBuilder('u');
        $query = $qb
            ->innerJoin('u.samorzad', 's')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)
        );

        return $this->render('admin/users.html.twig', array(
            'users'=>$users,
        ));
    }


    /**
     * @Route("/admin/user/edit/{id}/", name="admin_user_edytuj")
     */
    function EdytujUserAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('UserBundle:User');
        $user = $repo->find($id);

        $form = $this->createFormBuilder($user)
            ->add('username')
            ->add('email')
            ->add('samorzad', EntityType::class, array(
                'class'=>'AppBundle:Samorzad',
                'choice_label'=>'samorzad'
            ))
            ->add('save', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isValid()){
            $this->addFlash('notice', 'Pomyślnie zedytowano użytkownika '.$user->getUsername());
            $em->flush();
        }

        return $this->render('admin/edit_user.html.twig', array(
            'form'=>$form->createView(),
            'user'=>$user,
        ));
    }


    /**
     * @Route("/admin/user/accept/{id}", name="admin_user_accept")
     */
    function adminUserAcceptAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('UserBundle:User');
        $user = $repo->find($id);
        $user->setEnabled(1);

        $em->flush();
        $this->addFlash('notice', 'Pomyślnie zaakceptowano użytkownika '.$user->getUsername());
//        return $this->render('admin/index.html.twig', array(
//            'users'=>$users,
//        ));
        return $this->redirectToRoute('admin_index');
    }

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
            ->add('save', SubmitType::class, array('label'=>'Zapisz'))
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
