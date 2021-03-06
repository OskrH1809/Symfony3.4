<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Tapa;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Ingrediente2;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * 
     **/
     public function homeAction(Request $request)
    {   
        //capturar el repositorio de la tabla con la base de datos
        $repository = $this->getDoctrine()->getRepository(Tapa::class);
        $tapas = $repository->findByTop(1);
        // var_dump($tapas);
        // replace this example code with whatever you need
        return $this->render('frontal/index.html.twig',array('tapas'=>$tapas));
    }
    
     /**
     * @Route("/nosotros", name="nosotros")
     * 
     **/
    public function nosotrosAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontal/nosotros.html.twig');
    }

 
    /**
     * @Route("/contactar/{sitio}", name="contactar")
     * 
     **/
    public function contactarAction(Request $request,$sitio="todos")
    {
        // replace this example code with whatever you need
        return $this->render('frontal/bares.html.twig',array("sitio"=>$sitio));
    }

    /**
     * @Route("/tapa/{id}", name="tapa")
     * 
     **/
    public function tapaAction(Request $request,$id=null)
    {
        
        if ($id!=null) {
            $repository = $this->getDoctrine()->getRepository(Tapa::class);
            $tapa = $repository->find($id);
            return $this->render('frontal/tapa.html.twig',array("tapa"=>$tapa));
        }else{
            return $this->redirectToRoute('homepage');
        }
    }

    /**
     * @Route("/categoria/{id}", name="categoria")
     * 
     **/
    public function CatAction(Request $request,$id=null)
    {
        
        if ($id!=null) {
            $repository = $this->getDoctrine()->getRepository(Categoria::class);
            $categoria = $repository->find($id);
            return $this->render('frontal/categoria.html.twig',array("categoria"=>$categoria));
        }else{
            return $this->redirectToRoute('homepage');
        }
    }

       /**
     * @Route("/ingrediente2/{id}", name="ingrediente2")
     * 
     **/
    public function IngreAction(Request $request,$id=null)
    {
        
        if ($id!=null) {
            $repository = $this->getDoctrine()->getRepository(Ingrediente2::class);
            $ingrediente2 = $repository->find($id);
            return $this->render('frontal/ingrediente2.html.twig',array("ingrediente2"=>$ingrediente2));
        }else{
            return $this->redirectToRoute('homepage');
        }
    }




}
