<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
// use AppBundle\Entity\Categoria;


use AppBundle\Entity\Categoria;


  /**
     * @Route("/api")
     * 
     **/
class ApiController extends Controller
{
    function catToArray($categoria){
        $categoriasArray=array();
        $categoriasArray['id']=$categoria->getId();
        $categoriasArray['nombre']=$categoria->getNombre();
        $categoriasArray['descripcion']=$categoria->getDescripcion();
        return $categoriasArray;
    }
    function catsToArray($categorias){
        $categoriasArray=array();
        foreach ($categorias as $categoria) {
           $categoriasArray[]=$this->catToArray($categoria);
        }
        return $categoriasArray; 
    }
    /**
     * @Route("/listarCategorias", methods={"GET"})
     */
    public function listarCategoriaAction()
    {
        $repository = $this->getDoctrine()->getRepository(Categoria::class);
        $categorias = $repository->findAll();
        $response= new JsonResponse($this->catsToArray($categorias));
        return $response;
       
    }

    /**
     * @Route("/insertarCategoria/{nombre}/{descripcion}", methods={"POST"})
     */
    public function insertarAction($nombre="",$descripcion="")
    {
        if (strlen($nombre)>0) {

            $categoria =new Categoria();
            $categoria->setNombre($nombre);
            $categoria->setDescripcion($descripcion);
            $categoria->setFoto("");

            $em = $this->getDoctrine()->getManager();
            $em->persist($categoria);
            $em->flush();
            
            
            $response = new JsonResponse($this->catToArray($categoria));

            return $response; 
        }
        throw new BadRequestHttpException('falta nombre',null,400);
        
    }

}