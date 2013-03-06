<?php

namespace Bioversity\SliderBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SliderBundle\Repository\ServerConnection;
use Bioversity\SliderBundle\Form\SliderSearchNodeType;

class SliderController extends Controller
{
    /**
     *The slider index
     *
     */
    public function browseSliderAction()
    { 
        return $this->render('BioversitySliderBundle:Slider:browse_slider.html.twig');
    }
    
    /**
     * The node search tool
     *
     */
    public function partialNodeSearchAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new SliderSearchNodeType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $formData= $form->getData();
                $saver= new ServerConnection();
                $nodeList= $saver->getTerm();
                
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
            'BioversitySliderBundle:Slider:partial_search_node.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
    
    /**
     *The slider index for modal popup
     *
     */
    public function modalSliderAction($node_id)
    { 
        return $this->render('BioversitySliderBundle:Slider:modal_slider.html.twig', array('node_id' => $node_id));
    }
    
    /**
     *Json response for Root nodes
     *
     */
    public function JsonRootNodeAction(){
        $server= new ServerConnection();
        
        return new Response($server->getRootNodes());
    }
    
    /**
     *Json response for Node relation
     *
     */
    public function JsonNodeRelationsAction($nodeId){
        $server= new ServerConnection();
        
        return new Response($server->getNodeRelation($nodeId));
    }
    
    /**
     *Json response for Node details
     *
     */
    public function JsonNodeDetailsAction($nodeId){
        $server= new ServerConnection();
        
        return new Response($server->getNodeDetails($nodeId));
    }
    
    /**
     *Json response for Node in
     *
     */
    public function JsonNodeRelationINAction($nodeId, $page=null){
        $server= new ServerConnection();
        
        return new Response($server->getNodeRelationIN($nodeId, $page));
    }
    
    /**
     *Json response for Node out
     *
     */
    public function JsonNodeRelationOUTAction($nodeId, $page=null){
        $server= new ServerConnection();
        
        return new Response($server->getNodeRelationOUT($nodeId, $page));
    }
    
    /**
     *Json response for search Node in
     *
     */
    public function JsonSearchNodeRelationINAction($nodeId, $term=null){
        $server= new ServerConnection();
        
        return new Response($server->searchNodeRelationIN($nodeId, $term));
    }
    
    /**
     *Json response for search Node out
     *
     */
    public function JsonSearchNodeRelationOUTAction($nodeId, $term=null){
        $server= new ServerConnection();
        
        return new Response($server->searchNodeRelationOUT($nodeId, $term));
    }
}
