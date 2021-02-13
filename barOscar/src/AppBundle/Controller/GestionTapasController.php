<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\TapaType;
use AppBundle\Entity\Tapa;
use AppBundle\Form\CategoriaType;
use AppBundle\Entity\Categoria;

// use AppBundle\Form\TaskType;
  /**
     * @Route("/gestiontapas")
     * 
     **/
class GestionTapasController extends Controller
{

    /**
     * @Route("/nuevatapa", name="nuevaTapa")
     * 
     **/
    public function nuevaTapaAction(Request $request)
    { 
        $tapa = new Tapa();

        //construyendo formulario
        $form = $this->createForm(TapaType::class, $tapa);
        //recogemos la informacion
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $tapa = $form->getData();//rellenar la entity tapa
            $fotoFile=$tapa->getFoto();
            $fileName= $this->generateUniqueFileName().'.'.$fotoFile->guessExtension();

            $fotoFile->move(
                $this->getParameter('tapaImg_directory'),
                $fileName
            );
            
      

            $tapa->setFoto($fileName    );
            
            $tapa->setFechaCreacion(new \Datetime());
            //almacenar nueva tapa
            $em = $this->getDoctrine()->getManager();
            $em->persist($tapa);
            $em->flush();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
    
            return $this->redirectToRoute('tapa',array('id'=>$tapa->getId()));
            // return $this->render('test/test.html.twig');
        }
        //
        return $this->render('gestionTapas/nuevaTapa.html.twig',array('form'=>$form->createView()));
    }


    /**
     * @return string
     */
    private function generateUniqueFileName(){

        return md5(uniqid());
    }


    /**
     * @Route("/nuevacategoria", name="nuevacategoria")
     * 
     **/
    public function nuevaCatAction(Request $request)
    { 
        $categoria = new Categoria();

        //construyendo formulario
        $form = $this->createForm(CategoriaType::class, $categoria);
        //recogemos la informacion
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $categoria = $form->getData();//rellenar la entity tapa
            $fotoFile=$categoria->getFoto();
            $fileName= $this->generateUniqueFileName().'.'.$fotoFile->guessExtension();

            $fotoFile->move(
                $this->getParameter('tapaImg_directory'),
                $fileName
            );
            
      

            $categoria->setFoto($fileName    );
            
            // $categoria->setFechaCreacion(new \Datetime());
            //almacenar nueva tapa
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
    
            return $this->redirectToRoute('categoria',array('id'=>$categoria->getId()));
            // return $this->render('test/test.html.twig');
        }
        //
        return $this->render('gestionTapas/nuevacategoria.html.twig',array('form'=>$form->createView()));
    }


}
?>