<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Umowa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DodawanieController extends Controller
{
    /**
     * @Route("/admin/add", name="dodaj")
     */
    function DodajAction(Request $request){
        $umowa = new Umowa();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($umowa)
                        ->add('podmiot')
                        ->add('zadanie')
                        ->add('pkd')
                        ->add('uwagi')
                        ->add('save', SubmitType::class)
                        ->getForm();

        $form->handleRequest($request);

        if($form->isValid()){
            $em->persist($umowa);
            $em->flush();
            $this->addFlash('notice', 'Pomyślnie dodano umowę do bazy danych');
        }

        return $this->render('admin/add.html.twig', array(
            'form'=>$form->createView(),
        ));
    }
}
