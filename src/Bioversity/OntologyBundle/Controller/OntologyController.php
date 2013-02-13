<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\OntologyBundle\Form\OntologyNodeType;
use Bioversity\OntologyBundle\Form\OntologyTermType;
use Bioversity\OntologyBundle\Form\OntologyNamespaceType;
use Bioversity\OntologyBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\SecurityBundle\Repository\NotificationManager;

class OntologyController extends Controller
{    
    public function newTermAction(Request $request)
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
                    return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $newTerm= $saver->saveNew($this->clearSubmittedData($formData),'SetTerm');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                    
                    return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $newTerm[':WS:RESPONSE']['_term'][$newTerm[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:new_term.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
    
    public function jsonNewTermAction(Request $request)
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
                
                if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    return new Response(json_encode(array('term'=> '')));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $saved= $saver->saveNew($this->clearSubmittedData($formData),'SetTerm');
                    return new Response(json_encode(array('term'=> $saved)));
                }
            }
        }
        
        return new Response(json_encode(array('term'=> '')));
    }
    
       
    public function newNodeAction(Request $request, $term)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $saver= new ServerConnection();
        $nodes= $saver->getNodeByNIDTerm($term);
        $nodeList= (array_key_exists(':WS:RESPONSE', $nodes))? $nodes[':WS:RESPONSE']['_node'] : array();
        //print_r($nodeList);
        
        $form = $this->createForm(new OntologyNodeType(), array('nodes'=>$nodeList));
        $form->get(Tags::kTAG_PID)->setData($term);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $formData= $form->getData();
            if($formData['OntologyNode_node_related']){
              //var_dump($formData['node_related']);
              //die();
            }           
        
            if ($form->isValid()) {
                if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    $session->getFlashBag()->set('error',  NotificationManager::getNotice('element_exist', $code.' '.$namespace));
                }else{
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $saver->saveNew($this->clearSubmittedData($formData),'SetVertex');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:new_node.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
                'node_list'         => $nodeList
            ));
    }
    
    private function clearSubmittedData($formData)
    {
        foreach($formData as $data=>$value){
            if(!$value){
                unset($formData[$data]);
            }else if($data== Tags::kTAG_LABEL || $data== Tags::kTAG_DEFINITION){
                $formData[$data]= array('en' => $value);
            }
        }
        
        return $formData;
    }
    
    private function formatSynonyms($synonyms)
    {
        if($synonyms)
            return explode(',', $synonyms);
        else
            return NULL;
    }
    
    private function formatCategory($category)
    {
        if($category)
            return explode(',', $category);
        else
            return NULL;
    }
    
    private function getKeyValue($term, $key, $lang= false)
    {
        //print_r($term[':WS:STATUS']);
        $record= $term[':WS:RESPONSE'];
        $id= $record['_ids'][0];
        
        if(array_key_exists($key, $record['_term'][$id])){
            if($lang){
                return $record['_term'][$id][$key]['en'];
            }
            
            return $record['_term'][$id][$key];
        }else{
            return null;
        }
    }

//--------MODAL PARTIAL------------------------------
    
    public function modalNewTermAction(Request $request)
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
                    return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $newTerm= $saver->saveNew($this->clearSubmittedData($formData),'SetTerm');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                    
                    return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $newTerm[':WS:RESPONSE']['_term'][$newTerm[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:modal_new_term.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
    
    public function modalNewNamespaceAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyNamespaceType());
        
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
                    $this->createError($session, $form);
                    $session->getFlashBag()->set('error',  NotificationManager::getNotice('element_exist', $code.' '.$namespace));
                    $form = $this->createForm(new OntologyNamespaceType());
                    $form->get(Tags::kTAG_LID)->setData($this->getKeyValue($term, Tags::kTAG_LID));
                    $form->get(Tags::kTAG_NAMESPACE)->setData($this->getKeyValue($term, Tags::kTAG_NAMESPACE));
                    $form->get(Tags::kTAG_LABEL)->setData($this->getKeyValue($term, Tags::kTAG_LABEL, true));
                    $form->get(Tags::kTAG_DEFINITION)->setData($this->getKeyValue($term, Tags::kTAG_DEFINITION, true));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $saver->saveNew($this->clearSubmittedData($formData),'SetNamespace');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:modal_new_namespace.html.twig',
            array(
                'form'   => $form->createView(),
                'notice' => $session->getFlashBag()->get('notice'),
                'errors' => $session->getFlashBag()->get('error')
            ));
    }    
    
    public function modalNewNodeAction(Request $request, $term)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $saver= new ServerConnection();
        $nodes= $saver->getNodeByNIDTerm($term);
        $nodeList= (array_key_exists(':WS:RESPONSE', $nodes))? $nodes[':WS:RESPONSE']['_node'] : array();
        //print_r($nodeList);
        
        $form = $this->createForm(new OntologyNodeType(), array('nodes'=>$nodeList));
        $form->get(Tags::kTAG_PID)->setData($term);
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
            $formData= $form->getData();
            if($formData['OntologyNode_node_related']){
              //var_dump($formData['node_related']);
              //die();
            }           
        
            if ($form->isValid()) {
                if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    $session->getFlashBag()->set('error',  NotificationManager::getNotice('element_exist', $code.' '.$namespace));
                }else{
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $saver->saveNew($this->clearSubmittedData($formData),'SetVertex');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:modal_new_node.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
                'node_list'         => $nodeList
            ));
    }
    
//--------ASYNC METHODS-------------------------------
    
    /**
     *Json response for LID
     *
     */
    public function jsonFindLidAction($lid, $namespace=null)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->findLID($lid,$namespace)));
    }
    
    /**
     *Json response for TERM detail
     *
     */
    public function jsonGetTermAction($lid, $namespace=null)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->getTerm($lid,$namespace)));
    }
    
    /**
     *Json response for NAMESPACE
     *
     */
    public function jsonFindNamespaceAction($word)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->findNAMESPACE($word)));
    }
}