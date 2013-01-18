<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\OntologyBundle\Form\OntologyNodeType;
use Bioversity\OntologyBundle\Form\OntologyTermType;

class OntologyController extends Controller
{    
    public function newNodeAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyTermType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $term= $form->getData();
                $saver= new ServerConnection();
                $save= $saver->saveNewTerm($user['fullname'], $user['username'], $user['password'], $user['email'], $user['roles']);
                
                //return var_dump($save);
                if($save[':WS:STATUS'][':STATUS-CODE'] === 0){
                    //$notice->setNotice($save[':WS:STATUS'][':STATUS-CODE']);
                    $session->getFlashBag()->set('notice',  NotificationManager::getNotice($save[':WS:STATUS'][':STATUS-CODE']) );
                    return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
                }else{
                    $session->getFlashBag()->set('error', NotificationManager::getNotice($save[':WS:STATUS'][':STATUS-CODE']) );
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:new_node.html.twig',
            array(
                'form'   => $form->createView(),
                'notice' => $session->getFlashBag()->get('notice'),
                'errors' => $session->getFlashBag()->get('error')
            ));
    }
}