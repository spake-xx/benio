<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Umowa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Ddeboer\DataImport\Reader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CSVController extends Controller
{
    private $pola = array('podmiot', 'zadanie', 'pkd', 'uwagi', 'kwota');

    /**
     * @Route("/user/choice/import/", name="umowy_import")
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
            $pola = $this->pola;
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
    /**
     * @Route("/admin/import/", name="admin_import")
     */
    public function UmowyAdminImportAction(Request $request){
//        $csv = $this->get('ddeboer_data_import.reader.csv');
        $em = $this->getDoctrine()->getManager();

        $headers = null;
        $Data = null;

        $builder = $this->createFormBuilder();
        $form = $builder->add('attachment', FileType::class)
            ->add('samorzad', EntityType::class, array(
                'class'=>'AppBundle:Samorzad',
                'choice_label'=>'samorzad',
            ))
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
            $pola = $this->pola;
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
                $umowa->setSamorzad($form['samorzad']->getData());

                $em->persist($umowa);
                $em->flush();
            }

            fclose($file);
        }

        return $this->render('admin/import_form.html.twig', array(
            'form'=>$form->createView(),
            'headers'=>$headers,
            'data'=>$Data,
        ));
    }
    /**
     * @Route("/user/export/", name="umowy_export")
     */
    public function umowyExportAction(){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:Umowa');
        $samorzad = $this->getUser()->getSamorzad();
        $umowy = $repo->findBySamorzad($samorzad);
        $filename = "csv/".$samorzad->getKod().".csv";
        $file = fopen($filename, "wb");

        $i = 0;
        $string = '"';
        $separator = ",";
        foreach($umowy as $u){
            if($i==0){
                foreach($this->pola as $pole){
                    fwrite($file, $string.$pole.$string);
                    if($pole!=end($this->pola)){
                        fwrite($file, ',');
                    }else{
                        fwrite($file, "\n");
                    }
                }
            }

            fwrite($file, $string.$u->getPodmiot().$string.$separator);
            fwrite($file, $string.$u->getZadanie().$string.$separator);
            fwrite($file, $string.$u->getPkd().$string.$separator);
            fwrite($file, $string.$u->getUwagi().$string.$separator);
            fwrite($file, $string.$u->getKwota().$string.$separator);
            fwrite($file, "\n");





            $i++;
        }
        fclose($file);


        $response = new Response();

        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($filename));
            $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($filename) . '";');
        $response->headers->set('Content-length', filesize($filename));

        $response->sendHeaders();

        $response->setContent(file_get_contents($filename));


        return $response;
    }


}
