<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Umowa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Ddeboer\DataImport\Reader;

class CSVController extends Controller
{
    /**
     * @Route("/umowy/import", name="umowy_import")
     */
    public function UmowyImportAction(Request $request){
//        $csv = $this->get('ddeboer_data_import.reader.csv');
        $em = $this->getDoctrine()->getManager();

        $headers = null;
        $Data = null;

        $builder = $this->createFormBuilder();
        $form = $builder->add('attachment', FileType::class)
                        ->add('submit', SubmitType::class)->getForm();

        $form->handleRequest($request);
        if($form->isValid()) {
            $file = fopen($form['attachment']->getData(), 'rb');
            $context = array();
            $line = fgets($file);
            $headers = $line;

            while (!feof($file)) {
                $line = fgets($file);
                $context[] = $line;
            }

            $error = null;

            $headers = str_getcsv($headers, ",", '"');
            $pola = array('podmiot', 'zadanie', 'pkd', 'uwagi', 'kwota');
            foreach($pola as $k=>$p){
                if($headers[$k]!=$p){
                    $this->addFlash('warning', "Zła kolejność kolumn w pliku CSV !");
                    return $this->render('user/import_form.html.twig', array(
                        'form'=>$form->createView(),
                    ));
                }
            }


            $Data = array();
            array_pop($context);
            foreach($context as $linia){
                    $Data[] = str_getcsv($linia, ",", '"'); //parse the rows

            }
            foreach($Data as $u) {
                $umowa = new Umowa();
                $umowa->setPodmiot($u[0]);
                $umowa->setZadanie($u[1]);
                $umowa->setPkd($u[2]);
                $umowa->setUwagi($u[3]);
                $umowa->setKwota($u[4]);
                $umowa->setSamorzad($this->getUser()->getSamorzad());

                $em->persist($umowa);
                $em->flush();
            }

            fclose($file);
        }

        return $this->render('user/import_form.html.twig', array(
            'form'=>$form->createView(),
            'headers'=>$headers,
            'data'=>$Data,
        ));
    }
}
