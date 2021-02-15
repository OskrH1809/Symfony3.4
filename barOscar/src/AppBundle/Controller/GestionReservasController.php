<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\Extension\Core\Type\DateType;
// use Symfony\Component\Form\Extension\Core\Type\TextareaType;
// use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\ReservaType;
use AppBundle\Entity\Reserva;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// use AppBundle\Form\TaskType;
  /**
     * @Route("/reservas")
     * 
     **/
class GestionReservasController extends Controller
{

    /**
     * @Route("/nueva", name="nuevaReserva")
     * 
     **/
    public function nuevaTapaAction(Request $request)
    { 
        $reserva = new Reserva();
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $usuario= $this->getUser();
            $reserva->setUsuario($usuario);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reserva);
            $em->flush();

            return $this->redirectToRoute('reservas');
            
        }
        
        return $this->render('gestion/nuevaReserva.html.twig',array('form'=>$form->createView()));
    }



    /**
     * @Route("/reservas", name="reservas")
     * 
     **/
    public function reservasAction(Request $request){
        $repository = $this->getDoctrine()->getRepository(Reserva::class);
        $reservas = $repository->findAll();
        return $this->render('gestion/reservas.html.twig',array('reservas'=>$reservas));
    }


}
?>