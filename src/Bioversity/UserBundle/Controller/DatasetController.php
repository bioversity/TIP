<?php

namespace Bioversity\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Symfony\Component\HttpFoundation\Request;

class DatasetController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('BioversityUserBundle:Dataset:index.html.twig');
    }
    
    public function newAction()
    {
        return $this->render('BioversityUserBundle:Dataset:new_dataset.html.twig');
    }
}
