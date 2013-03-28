<?php

namespace Bioversity\TraitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\SecurityBundle\Repository\NotificationManager;
use Bioversity\TraitBundle\Form\TraitType;
use Bioversity\TraitBundle\Form\BestFilterType;
use Bioversity\TraitBundle\Repository\TraitConnection;

class TraitController extends Controller
{
    public function indexAction(Request $request)
    {
        $data= array();
        $pager= array();
        $status= array();
        $page= 1;
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $formBase = $this->createForm(new TraitType());
        $formAdvance = $this->createForm(new BestFilterType());
        
        if ($request->getMethod() == 'POST') {
            $formBase->bindRequest($request);
        
            if ($formBase->isValid()) {                
                $server= new TraitConnection();
                $traitValue= $formBase->get('trait')->getData();
                $trait= $server->getTrait($traitValue);
                
                if($trait[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    $formAdvance->get('trait')->setData($traitValue);
                    $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
                    $tagsList= $server->getTags($features);
                    
                    if(array_key_exists(':WS:RESPONSE', $tagsList)){
                        $tags= $this->getTags($tagsList[':WS:RESPONSE']['_tag']);
                        $dataList= $server->getData($tags);
                    
                        if(array_key_exists(':WS:RESPONSE', $dataList)){
                            $data=$dataList[':WS:RESPONSE'];
                            $pager= $dataList[':WS:PAGING'];
                            $status= $dataList[':WS:STATUS'];
                            $formAdvance->get('page')->setData($page);
                        }else{
                            $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                        }
                    }else{
                        $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                    }
                    //print_r($dataList[':WS:STATUS']);
                    //print_r($dataList[':WS:PAGING']);
                }else{
                    $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                }
            }
        }
        
        return $this->render(
            'BioversityTraitBundle:Trait:index.html.twig',
            array(
                'form_base'         => $formBase->createView(),
                'form_advance'      => $formAdvance->createView(),
                'datalist'          => $data,
                'pager'             => $pager,
                'status'            => $status,
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
            ));
    }
    
    public function bestFilterAction(Request $request)
    {
        $data= array();
        $pager= array();
        $status= array();
        $page= 1;
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $formBase = $this->createForm(new TraitType());
        $formAdvance = $this->createForm(new BestFilterType());
        
        if ($request->getMethod() == 'POST') {
            $formAdvance->bindRequest($request);
        
            if ($formAdvance->isValid()) {                
                $server= new TraitConnection();
                $traitValue= $formAdvance->get('trait')->getData();
                $page= $formAdvance->get('page')->getData();
                $location= $formAdvance->get('location')->getData();
                //$species= $formAdvance->get('species')->getData();
                
                $trait= $server->getTrait($traitValue);
                
                if($trait[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
                    $formBase->get('trait')->setData($traitValue);
                    $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
                    $tagsList= $server->getTags($features);
                    
                    if(array_key_exists(':WS:RESPONSE', $tagsList)){
                        $tags= $this->getTags($tagsList[':WS:RESPONSE']['_tag']);
                        $dataList= $server->getData($tags, $location, $page);
                    
                        if(array_key_exists(':WS:RESPONSE', $dataList)){
                            $data= $dataList[':WS:RESPONSE'];
                            $pager= $dataList[':WS:PAGING'];
                            $status= $dataList[':WS:STATUS'];
                        }else{
                            $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                        }
                    }else{
                        $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                    }
                }else{
                    $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
                }
            }
        }
        
        //print_r($dataList[':WS:REQUEST']);
        
        return $this->render(
            'BioversityTraitBundle:Trait:index.html.twig',
            array(
                'form_base'         => $formBase->createView(),
                'form_advance'      => $formAdvance->createView(),
                'datalist'          => $data,
                'pager'             => $pager,
                'status'            => $status,
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
            ));
    }
    
    private function getTags($elements)
    {
        $tags= array();
        foreach($elements as $key=>$value){
            if(count($value[Tags::kTAG_OFFSETS]) > 0){
                foreach($value[Tags::kTAG_OFFSETS] as $tag=>$one)
                $tags[]= $one;
            }
        }
        
        return $tags;
    }
}
