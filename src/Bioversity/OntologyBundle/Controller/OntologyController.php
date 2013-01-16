<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\OntologyBundle\Form\OntologyNodeType;

class OntologyController extends Controller
{
    public function newNodeAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyNodeType());
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:new_node.html.twig',
            array(
                'form'   => $form->createView(),
                'notice' => $session->getFlashBag()->get('notice'),
                'errors' => $session->getFlashBag()->get('error')
            ));
    }
}