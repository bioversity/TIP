<?php

namespace Bioversity\OntologyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function dashboardAction()
    {
        return $this->render('BioversityOntologyBundle:Default:index.html.twig');
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
}