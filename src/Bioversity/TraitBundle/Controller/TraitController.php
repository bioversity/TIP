<?php

namespace Bioversity\TraitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\SecurityBundle\Repository\NotificationManager;
use Bioversity\TraitBundle\Form\TraitType;
use Bioversity\TraitBundle\Form\TraitTagsType;
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
    public function jsonGetTagFieldsAction(Request $request)
    {
        $word= json_decode(stripslashes($request->get('word')));
        //$word = json_decode(stripslashes($_POST['word']));
        
        $server= new TraitConnection();
        $traits= $server->getTraits($word);
        
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
        //$request = $this->getRequest();
        $session = $request->getSession();
        
        $server= new TraitConnection();
        
        $formData= array();
        
        $postValue= $this->get('request')->request;
        
        foreach($postValue as $key=>$value){
            if(is_array($value)){
                foreach($value as $array=>$postdata){
                    if(!$postdata)
                        unset($value[$array]);
                }
            }
            
            if($key !== '_token' && $key !== 'page'){
                $newKeys= explode('_',$key);
                foreach($newKeys as $newKey=>$new){
                    if($newKey != 0){
                        $lastKey= $newKeys[count($newKeys)-1];
                        if($lastKey != 'enabler'){
                            $formData[$newKeys[0]][str_replace(':','.',$new)]= $value;
                            //this unset is used to delete duplicate key
                            unset($formData[str_replace(':','.',$new)]);
                        }else{
                            if(!array_key_exists($newKeys[count($newKeys)-2], $formData))
                                $formData[str_replace(':','.',$newKeys[count($newKeys)-2])][str_replace(':','.',$newKeys[count($newKeys)-2])][]= '';
                        }
                    }
                }
            }
        }
        
        //print_r($formData);
        //return new Response(json_encode($postValue));
        $unitsList= $server->getUnits($formData, $postValue->get('page'));
                
        if (
            $this->get('security.context')->isGranted('ROLE_ADMIN') &&
            ($this->get('kernel')->getEnvironment() != 'test') //hack to blok request print in test
        ){
            print_r('<pre style="height:200px;overflow: auto;">');
            print_r($unitsList);
            print_r('</pre>');
        }
        
        $units= array();
        $tags= array();
        $terms= array();
        $pagecount= 0;
        $totalunit= 0;
        
        if($unitsList->getStatus()->getAffectedCount() > 0){
            $pagecount= ceil($unitsList->getStatus()->getAffectedCount()/$unitsList->getPaging()->getPageLimit());
            $totalunit= $unitsList->getStatus()->getAffectedCount();
            
            if($unitsList->getResponse()){
                $data  = $unitsList->getResponse();
                $units = $data->getUnit();
                $tags  = $data->getTag();
                $terms = $data->getTerm();
            }else{
                $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
            }
        }
        
        //TODO. use this to check the request type
        //print_r($request->isXmlHttpRequest());
        return $this->render(
            'BioversityTraitBundle:Trait:unit_list.html.twig',
            array(
                'units'         => $units,
                'tags'          => $tags,
                'terms'         => $terms,
                'pagecount'     => $pagecount,
                'actualpage'    => $postValue->get('page'),
                'totalunit'     => $totalunit,
                'errors'        => $session->getFlashBag()->get('error')
            ));
    }
    
    public function jsonGetTrialAction(Request $request, $unit, $structKey, $page)
    {
        $pagecount= 0;
        $totalunit= 0;
        
        $server= new TraitConnection();
        $trials= $server->getTrials(urldecode($structKey), urldecode($unit), $page);
        
        $units= $trials->getResponse()->getUnit();
        foreach($trials->getResponse()->getUnit() as $key=>$value){
            foreach($value as $k=>$v){
                $tag= $server->getUnit($v);
                if($k == Tags::kTAG_UNIT ){
                    $units[$key]['tag']= $tag->getResponse()->getIds()[0];
                    break;
                }else{
                    $units[$key]['tag']= null;
                }
            }
        }
        
        $pagecount= ceil($trials->getStatus()->getAffectedCount()/$trials->getPaging()->getPageLimit());
        $totalunit= $trials->getStatus()->getAffectedCount();
        
        return $this->render(
            'BioversityTraitBundle:Trait:trials_list.html.twig',
            array(
                'trials'     => $units,
                'response'   => $trials->getResponse(),
                'tags'       => $trials->getResponse()->getTag(),
                'terms'      => $trials->getResponse()->getTerm(),
                'pagecount'  => $pagecount,
                'actualpage' => $page,
                'totalunit'  => $totalunit,
                'unit'       => $unit,
                'structKey'  => $structKey
            ));
    }
    
    public function jsonGetTrialDetailAction(Request $request, $unit)
    {        
        $server= new TraitConnection();
        $trial= $server->getUnitByGID(urldecode($unit));
        
        return $this->render(
            'BioversityTraitBundle:Trait:more_detail_page.html.twig',
            array(
                'data'       => $trial->getResponse()->getUnit()[urldecode($unit)],
                'tags'       => $trial->getResponse()->getTag(),
                'terms'      => $trial->getResponse()->getTerm(),
                'datalist'   => $trial->getResponse(),
                'unit'       => $unit
            ));
    }
    
    public function jsonGetTrialMapAction($coords){
        $coordsArray= explode('_', $coords);
        
        return $this->render(
            'BioversityTraitBundle:Trait:trials_map.html.twig',
            array(
                'long' => $coordsArray[1],
                'lat'  => $coordsArray[0]
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

}