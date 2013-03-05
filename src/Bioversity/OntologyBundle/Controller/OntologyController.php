<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\OntologyBundle\Form\OntologyNodeType;
use Bioversity\OntologyBundle\Form\OntologyPredicateType;
use Bioversity\OntologyBundle\Form\OntologyTermType;
use Bioversity\OntologyBundle\Form\OntologyNamespaceType;
use Bioversity\OntologyBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\DataFormatterHelper;
use Bioversity\SecurityBundle\Repository\NotificationManager;
use Bioversity\SliderBundle\Controller\SliderController;

class OntologyController extends Controller
{
    public function browseSliderAction(Request $request)
    {
        return $this->render('BioversityOntologyBundle:Ontology:slider_add_node.html.twig');
    }
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
                    $newTerm= $saver->saveNew(DataFormatterHelper::clearSubmittedData($formData),'SetTerm');
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
    
    public function newPredicateAction(Request $request, $node)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyPredicateType());
        
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
            'BioversityOntologyBundle:Ontology:new_predicate.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
    
    public function newNodeAction(Request $request, $term)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $saver= new ServerConnection();
        $nodes= $saver->getNodeByNIDTerm($term);
        $nodeList= (array_key_exists(':WS:RESPONSE', $nodes))? $nodes[':WS:RESPONSE']['_node'] : array();
        
        $form = $this->createForm(new OntologyNodeType(), array('nodes'=>$nodeList));
        $form->get(Tags::kTAG_PID)->setData($term);
        
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
        
            if ($form->isValid()){
                $formData= $form->getData();
                
                if(count($formData['node_related']) > 0){
                    return $this->redirect($this->generateUrl('bioversity_ontology_predicate_new', array('node' => $formData['node_related'])));
                }else{
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $node= $saver->saveNew($this->clearSubmittedData($formData),'SetVertex');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($node[':WS:STATUS'][':STATUS-CODE']) );
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




//--------INCLUDED PARTIAL------------------------------

    public function partialNewNodeAction(Request $request, $term)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $saver= new ServerConnection();
        $nodes= $saver->getNodeByNIDTerm($term);
        $nodeList= (array_key_exists(':WS:RESPONSE', $nodes))? $nodes[':WS:RESPONSE']['_node'] : array();
        //print_r($nodeList);
        
        $form = $this->createForm(new OntologyNodeType(), array('nodes'=>$nodeList));
        //$form->get(Tags::kTAG_PID)->setData($term);
        
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
            'BioversityOntologyBundle:Ontology:partial_new_node.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
                'node_list'         => $nodeList
            ));
    }
    
    public function partialNewPredicateAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyPredicateType());
        
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
                    return new Response(json_encode(array('term'=> '')));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $saved= $saver->saveNew($this->clearSubmittedData($formData),'SetTerm');
                    return new Response(json_encode(array('term'=> $saved)));
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:partial_new_predicate.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
    

    public function partialNewTermAction(Request $request)
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
            'BioversityOntologyBundle:Ontology:partial_new_term.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
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
    
    public function modalNewPredicateAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyPredicateType());
        
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
                    return $this->redirect($this->generateUrl('bioversity_ontology_predicate_new', array('term' => $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }else{
                    $formData[Tags::kTAG_SYNONYMS]= $this->formatSynonyms($formData[Tags::kTAG_SYNONYMS]);
                    $formData[Tags::kTAG_CATEGORY]= $this->formatSynonyms($formData[Tags::kTAG_CATEGORY]);
                    $newTerm= $saver->saveNew($this->clearSubmittedData($formData),'SetTerm');
                    $session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                    
                    return $this->redirect($this->generateUrl('bioversity_ontology_predicate_new', array('term' => $newTerm[':WS:RESPONSE']['_term'][$newTerm[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                }
            }
        }
        
        return $this->render(
            'BioversityOntologyBundle:Ontology:modal_new_predicate.html.twig',
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

    public function jsonNewPredicateAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyPredicateType());
    
        return $this->checkForm($request, $form);
    }
    
    public function jsonNewNodeAction(Request $request, $term)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $saver= new ServerConnection();
        //return print_r($saver->getTermByCode($term));
        $nodes= $saver->getNodeByNIDTerm($term);
        $nodeList= (array_key_exists(':WS:RESPONSE', $nodes))? $nodes[':WS:RESPONSE']['_node'] : array();
        
        $form = $this->createForm(new OntologyNodeType(), array('nodes'=>$nodeList));
    
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $formData= $form->getData();
                
                $saver= new ServerConnection();
                $formData[Tags::kTAG_TERM]= $term;
                $formData[Tags::kTAG_EXAMPLES]= array($form->get(Tags::kTAG_EXAMPLES)->getData());
                $formData[Tags::kTAG_DESCRIPTION]= array($form->get(Tags::kTAG_DESCRIPTION)->getData());
                $class= $form->get('node_class')->getData();
                $formData['node_class']= '';
                $formData['nodes']= '';
                
                $saved= $saver->saveNew($this->clearSubmittedData($formData),'SetVertex', $class);
                return new Response(json_encode(array('term'=> $saved)));
            }
        }
    }
    
    public function jsonNewTermAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new OntologyTermType());
    
        return $this->checkForm($request, $form);
    }
    
    public function jsonNewRelationAction(Request $request, $subject, $predicate, $object)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->saveRelation($subject, $predicate, $object)));
    }   
    public function jsonFindLidAction($lid, $namespace=null)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->findLID($lid,$namespace)));
    }
    
    public function jsonFindLabelAction($label)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->findLABEL($label)));
    }
    
    public function jsonGetTermAction($lid, $namespace=null)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->getTerm($lid,$namespace)));
    }
    
    
    public function jsonFindNamespaceAction($word)
    {
        $server= new ServerConnection();
        return  new Response(json_encode($server->findNAMESPACE($word)));
    }

//------------PRIVATE---------------------------------------

    private function checkForm(Request $request, $form)
    {
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $formData= $form->getData();
                $code= $formData[Tags::kTAG_LID];
                $namespace= $formData[Tags::kTAG_NAMESPACE];
                $saver= new ServerConnection();
                $term= $saver->getTerm($code, $namespace);
                
                //print_r($term[':WS:RESPONSE']);
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
}