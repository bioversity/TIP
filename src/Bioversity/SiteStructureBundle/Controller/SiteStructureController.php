<?php

namespace Bioversity\SiteStructureBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SiteStructureBundle\Form\searchTraitType;


class SiteStructureController extends Controller
{
    public function indexAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:index.html.twig');
    }
    
    public function loginAction()
    {
        return $this->redirect('admin/dashboard');
        return $this->render('BioversitySiteStructureBundle:SiteStructure:index.html.twig');
    }
    
    public function onlineChatAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:online_chat.html.twig');
    }
    
    public function conservatonStrategiesAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:conservation_strategies.html.twig');
    }
    
    public function nationalInventoriesAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:national_inventories.html.twig');
    }
    
    public function contactAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:contact.html.twig');
    }
    
    public function aboutAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:about.html.twig');
    }

    public function databaseAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:database.html.twig');
    }
    
    public function browseLandraceAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:index.html.twig');
    }

    public function browseCwrAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:index.html.twig');
    }

    public function browseTraitAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new searchTraitType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                //$saver= new ServerConnection();
                //$term= $saver->getTerm($code, $namespace);
                
                //print_r($term);
                //if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    //return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                //}else{
                    //$newTerm= $saver->saveNew(DataFormatterHelper::clearSubmittedData($formData),'SetTerm');
                    //$session->getFlashBag()->set('notice', NotificationManager::getNotice($term[':WS:STATUS'][':STATUS-CODE']) );
                    
                    //return $this->redirect($this->generateUrl('bioversity_ontology_node_new', array('term' => $newTerm[':WS:RESPONSE']['_term'][$newTerm[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_GID])));
                //}
            }
        }
        
        return $this->render(
            'BioversitySiteStructureBundle:SiteStructure:trait.html.twig',
            array(
                'form'              => $form->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }

    public function dashboardAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:dashboard.html.twig');
    }

    public function editProfileAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:index.html.twig');
    }

    public function datasetsAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:datasets.html.twig');
    }

    public function dataSearchAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:data_search.html.twig');
    }

    public function downloadDataAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:download_data.html.twig');
    }

    public function requestDataAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:request_data.html.twig');
    }

    public function contributeDataAction()
    {
        return $this->render('BioversitySiteStructureBundle:SiteStructure:contribute_data.html.twig');
    }
}
