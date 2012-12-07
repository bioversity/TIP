<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Bioversity\OntologyBundle\Repository\ServerConnection;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }

    public function registrationAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }
    
    public function loginAction()
    {
        return $this->redirect('admin/dashboard');
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('BioversityOntologyBundle:Default:contact.html.twig');
    }
    
    public function aboutAction()
    {
        return $this->render('BioversityOntologyBundle:Default:about.html.twig');
    }

    public function databaseAction()
    {
        return $this->render('BioversityOntologyBundle:Default:database.html.twig');
    }
    
    public function browseLandraceAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }

    public function browseCwrAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }

    public function browseTraitAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }

    public function browseSliderAction()
    { 
        return $this->render('BioversityOntologyBundle:Default:browse_slaider.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('BioversityOntologyBundle:Default:dashboard.html.twig');
    }

    public function editProfileAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
    }

    public function datasetsAction()
    {
        return $this->render('BioversityOntologyBundle:Default:datasets.html.twig');
    }

    public function dataSearchAction()
    {
        return $this->render('BioversityOntologyBundle:Default:data_search.html.twig');
    }

    public function downloadDataAction()
    {
        return $this->render('BioversityOntologyBundle:Default:download_data.html.twig');
    }

    public function requestDataAction()
    {
        return $this->render('BioversityOntologyBundle:Default:request_data.html.twig');
    }

    public function contributeDataAction()
    {
        return $this->render('BioversityOntologyBundle:Default:contribute_data.html.twig');
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
}