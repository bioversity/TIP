<?php

namespace Bioversity\TraitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\SecurityBundle\Repository\NotificationManager;
use Bioversity\TraitBundle\Form\TraitType;
use Bioversity\TraitBundle\Form\BestFilterType;
use Bioversity\TraitBundle\Form\TraitTagsType;
use Bioversity\TraitBundle\Repository\TraitConnection;

class TraitController extends Controller
{
    //public function indexAction(Request $request)
    //{
    //    $data= array();
    //    $pager= array();
    //    $status= array();
    //    $page= 1;
    //    
    //    $request = $this->getRequest();
    //    $session = $request->getSession();
    //    
    //    $formBase = $this->createForm(new TraitType());
    //    $formAdvance= null;
    //    
    //    if ($request->getMethod() == 'POST') {
    //        $formBase->bindRequest($request);
    //    
    //        if ($formBase->isValid()) {
    //            $server= new TraitConnection();
    //            $traitValue= $formBase->get('trait')->getData();
    //            $trait= $server->getTrait($traitValue);
    //            
    //            if($trait[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
    //                $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
    //                $tagsList= $server->getTags($features);
    //                
    //                if(array_key_exists(':WS:RESPONSE', $tagsList)){
    //                    $tags= $this->getTags($tagsList[':WS:RESPONSE']['_tag']);
    //                    $dataList= $server->getData($tags);
    //                
    //                    if(array_key_exists(':WS:RESPONSE', $dataList)){
    //                        $formAdvance = $this->createForm(new BestFilterType(),array('trait' => $traitValue, 'tags' => $tags));
    //                        $formAdvance->get('trait')->setData($traitValue);
    //            
    //                        $data=$dataList[':WS:RESPONSE'];
    //                        $pager= $dataList[':WS:PAGING'];
    //                        $status= $dataList[':WS:STATUS'];
    //                        $formAdvance->get('page')->setData($page);
    //                    }else{
    //                        $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //                    }
    //                }else{
    //                    $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //                }
    //                //print_r($dataList[':WS:STATUS']);
    //                //print_r($dataList[':WS:PAGING']);
    //            }else{
    //                $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //            }
    //        }
    //    }
    //    
    //    return $this->render(
    //        'BioversityTraitBundle:Trait:index.html.twig',
    //        array(
    //            'form_base'         => $formBase->createView(),
    //            'form_advance'      => $formAdvance? $formAdvance->createView(): null,
    //            'datalist'          => $data,
    //            'pager'             => $pager,
    //            'status'            => $status,
    //            'notice'            => $session->getFlashBag()->get('notice'),
    //            'errors'            => $session->getFlashBag()->get('error'),
    //        ));
    //}
    
    //public function bestFilterAction(Request $request)
    //{
    //    $data= array();
    //    $pager= array();
    //    $status= array();
    //    $page= 1;
    //    
    //    $request = $this->getRequest();
    //    $session = $request->getSession();
    //    
    //    $formBase = $this->createForm(new TraitType());
    //    $formAdvance = $this->createForm(new BestFilterType(), array());
    //    
    //    if ($request->getMethod() == 'POST') {
    //        $formAdvance->bindRequest($request);
    //    
    //        if ($formAdvance->isValid()) {                
    //            $server= new TraitConnection();
    //            $traitValue= $formAdvance->get('trait')->getData();
    //            $page= $formAdvance->get('page')->getData();
    //            $location= $formAdvance->get('location')->getData();
    //            $species= $formAdvance->get('species')->getData();
    //            
    //            $trait= $server->getTrait($traitValue);
    //            
    //            if($trait[':WS:STATUS'][':WS:AFFECTED-COUNT'] > 0){
    //                $formBase->get('trait')->setData($traitValue);
    //                $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
    //                $tagsList= $server->getTags($features);
    //                
    //                if(array_key_exists(':WS:RESPONSE', $tagsList)){
    //                    $tags= $this->getTags($tagsList[':WS:RESPONSE']['_tag']);
    //                    $dataList= $server->getData($tags, $location, $page, $species);
    //                
    //                    if(array_key_exists(':WS:RESPONSE', $dataList)){
    //                        $formAdvance = $this->createForm(new BestFilterType(),array('trait' => $traitValue, 'tags' => $tags));
    //                        $formAdvance->get('page')->setData($page);
    //                        $formAdvance->get('location')->setData($location);
    //                        $formAdvance->get('trait')->setData($traitValue);
    //                        $formAdvance->get('species')->setData($species);
    //                        
    //                        $data= $dataList[':WS:RESPONSE'];
    //                        $pager= $dataList[':WS:PAGING'];
    //                        $status= $dataList[':WS:STATUS'];
    //                    }else{
    //                        $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //                    }
    //                }else{
    //                    $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //                }
    //            }else{
    //                $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
    //            }
    //        }
    //    }
    //    
    //    //print_r($dataList[':WS:REQUEST']);
    //    
    //    return $this->render(
    //        'BioversityTraitBundle:Trait:index.html.twig',
    //        array(
    //            'form_base'         => $formBase->createView(),
    //            'form_advance'      => $formAdvance->createView(),
    //            'datalist'          => $data,
    //            'pager'             => $pager,
    //            'status'            => $status,
    //            'notice'            => $session->getFlashBag()->get('notice'),
    //            'errors'            => $session->getFlashBag()->get('error'),
    //        ));
    //}    
    
    public function indexAction(Request $request)
    {
        $data= array();
        $pager= array();
        $status= array();
        $page= 1;
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $formBase = $this->createForm(new TraitType());
        
        return $this->render(
            'BioversityTraitBundle:Trait:trait.html.twig',
            array(
                'form_base'         => $formBase->createView(),
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
            ));
    }
    
    public function findTrait()
    {
        
    }
    
    
//---------------JSON---------------//
    public function jsonGetTagFieldsAction($word)
    {
        $server= new TraitConnection();
        $traits= $server->getTraits($word);
        
        //print_r($traits);
        
        $form= $this->createForm(new TraitTagsType($traits));
        
        return $this->render(
            'BioversityTraitBundle:Trait:input_fields.html.twig',
            array(
                'form'      => $form->createView(),
                'argument'  => $word
            ));
    }
    
    public function jsonFindTraitsAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $server= new TraitConnection();
        
        $formData= array();
        foreach($_POST as $key=>$value){
            if($value){
                if($key !== '_token' && $key !== 'page'){
                    $newKey= explode('_',$key);
                    $formData[$newKey[0]][$newKey[count($newKey)-1]]= $value; 
                }
            }
        }
        
        $units= $server->getUnits($formData, $_POST['page']);
        
        //print_r($units[':WS:RESPONSE']['_unit']);
        //print_r($units[':WS:RESPONSE']['_tag']);
        
        $data= array();
        $pagecount= ceil($units[':WS:STATUS'][':WS:AFFECTED-COUNT']/$units[':WS:PAGING'][':WS:PAGE-LIMIT']);
        
        if(array_key_exists(':WS:RESPONSE',$units)){
            $data= $units[':WS:RESPONSE'];
        }else{
            $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
        }
        
        //print_r($request->isXmlHttpRequest());
        return $this->render(
            'BioversityTraitBundle:Trait:unit_list.html.twig',
            array(
                'datalist'      => $data,
                'pagecount'     => $pagecount,
                'actualpage'    =>$_POST['page'],
                'totalunit'     =>$units[':WS:STATUS'][':WS:AFFECTED-COUNT'],
                'errors'        => $session->getFlashBag()->get('error'),
            ));
    }

    
//--------------PRIVATE-------------//

    
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
    
    //private function getTagList($traits)
    //{
    //    $tags= array();
    //    foreach($traits[':WS:RESPONSE']['_ids'] as $key=>$value){
    //        $tags[]= $traits[':WS:RESPONSE']['_tags'][$value][Tags::kTAG_PATH][];
    //    }
    //    
    //    return $tags;
    //}

}
