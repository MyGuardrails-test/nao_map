<?php

namespace NAO\MapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use NAO\MapBundle\Entity\Observation;
use NAO\MapBundle\Form\ObservationType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    public function indexAction()
    {        
        return $this->render('NAOMapBundle:Default:index.html.twig'
        );
    }

    public function observationsAction() {
      $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('NAOMapBundle:Observation')
        ;

        $listObs = $repository->myFindAll();
        
        return new JsonResponse($listObs);

    }

    public function addAction(Request $request)
    {


        $obs = new Observation();
        $form = $this->get('form.factory')->create(ObservationType::class, $obs);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($obs);
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Observation bien enregistrée.');

          return $this->redirectToRoute('nao_map_homepage');
        }

        return $this->render('NAOMapBundle:Default:add.html.twig', array(
          'obs' => $obs,
          'form' => $form->createView()
        ));
    }
}
