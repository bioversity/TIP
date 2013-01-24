<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\OntologyBundle\Form\OntologyNodeType;
use Bioversity\OntologyBundle\Form\OntologyTermType;
use Bioversity\OntologyBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\SecurityBundle\Repository\NotificationManager;

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
                $formData= $form->getData();
                $code= $formData[Tags::kTAG_LID];
                $namespace= $formData[Tags::kTAG_NAMESPACE];
                $saver= new ServerConnection();
                $term= $saver->getTerm($code, $namespace);
                
                //print_r($term);
                if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    $session->getFlashBag()->set('error',  NotificationManager::getNotice('element_exist', $code.' '.$namespace));
                    $form = $this->createForm(new OntologyTermType());
                    $form->get(Tags::kTAG_LID)->setData($this->getKeyValue($term, Tags::kTAG_LID));
                    $form->get(Tags::kTAG_NAMESPACE)->setData($this->getKeyValue($term, Tags::kTAG_NAMESPACE));
                    $form->get(Tags::kTAG_LABEL)->setData($this->getKeyValue($term, Tags::kTAG_LABEL, true));
                    $form->get(Tags::kTAG_LABEL)->setReadOnly();
                    $form->get(Tags::kTAG_DEFINITION)->setData($this->getKeyValue($term, Tags::kTAG_DEFINITION, true));
                }else{
                    $saver->saveNewTerm();
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
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
    
    private function getKeyValue($term, $key, $lang= false)
    {
        $record= $term[':WS:RESPONSE']; 
        $id= $record['_ids'][0];
        
        if($lang)
            return $record['_term'][$id][$key]['en'];
        
        return $record['_term'][$id][$key];
    }
}