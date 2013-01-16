<?php

namespace Bioversity\SliderBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SliderBundle\Repository\ServerConnection;

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
