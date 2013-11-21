<?php

namespace Bioversity\TraitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
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
    
    public function jsonFindSummaryTraitsAction(Request $request)
    {
        $session = $request->getSession();
        
        $server= new TraitConnection();
        
        $formData= array();
        
        $postValue= $this->get('request')->request->all();
        
        $formData= $this->getFeaturedData($postValue);
        
        $summaryList= $server->GetFeatured($formData, true);
        $units= array();
        $tags= array();
        $terms= array();
        $distincts= array();
        $links= array();
        $pagecount= 0;
        $totalunit= 0;
        
        if($summaryList->getStatus()->getAffectedCount() > 0){
            $pagecount= ceil($summaryList->getStatus()->getAffectedCount()/$summaryList->getPaging()->getPageLimit());
            $totalunit= $summaryList->getStatus()->getAffectedCount();
            
            if($summaryList->getResponse()){
                $data      = $summaryList->getResponse();
                $units     = $data->getUnit();
                $tags      = $data->getTag();
                $terms     = $data->getTerm();
                $distincts = $data->getDistinct();
                foreach($distincts as $key=>$value){
                    foreach($value as $k=>$v){
                        //$links[$k]= $server->getUnitsFilterByDomain($formData, $k);
                        $links[$k]= $formData;
                        $links[$k][]= $server->createQuery(Tags::kTAG_DOMAIN,null,$k);
                    }
                }                
            }else{
                $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
            }
        }
        
        if (
            $this->get('security.context')->isGranted('ROLE_ADMIN') &&
            ($this->get('kernel')->getEnvironment() != 'test') //hack to blok request print in test
        ){
            print_r('<pre style="height:200px;overflow: auto;">');
            print_r($summaryList);
            print_r('</pre>');
        }
        
        return $this->render(
            'BioversityTraitBundle:Trait:summary.html.twig',
            array(
                'units'         => $units,
                'tags'          => $tags,
                'terms'         => $terms,
                'distincts'     => $distincts,
                'links'         => json_encode($links),
                'pagecount'     => $pagecount,
                'actualpage'    => $postValue['page'],
                'totalunit'     => $totalunit,
                'errors'        => $session->getFlashBag()->get('error')
            ));
    }
    
    public function jsonFindTraitsAction(Request $request)
    {
        $session = $request->getSession();
        
        $server= new TraitConnection();
        
        $postValue= $request->get('url');
        
        //$unitsList= $server->sendUrl($postValue);
        $formData= json_decode($postValue, true);
        
        $page= 0;
        foreach($formData as $array=>$value){
            if(is_array($value)){
                if(array_key_exists('pagerequired', $value)){
                   $page= $value['pagerequired'];
                   unset($formData[$array]);
                }
            }
        }
        
        $unitsList=  $server->GetFeatured($formData, null, $page);
        
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
        
        $nextpage= $formData;
        $prevpage= $formData;
        $nextpage[]= array('pagerequired'=>$server->getNextPage($unitsList->getRequest()->getPageStart()));
        $prevpage[]= array('pagerequired'=>$server->getPrevPage($unitsList->getRequest()->getPageStart())); //$server->getPrevPage($formData, $unitsList->getRequest()->getPageStart());
        $actualpage= ceil($unitsList->getRequest()->getPageStart()/10);
        
        return $this->render(
            'BioversityTraitBundle:Trait:unit_list.html.twig',
            array(
                'units'         => $units,
                'tags'          => $tags,
                'terms'         => $terms,
                'pagecount'     => $pagecount,
                'totalunit'     => $totalunit,
                'actualpage'    => $actualpage,
                'nextpage'      => json_encode($nextpage),
                'prevpage'      => json_encode($prevpage),
                'errors'        => $session->getFlashBag()->get('error')
            ));
    }
    
    public function jsonGetTrialAction(Request $request, $unit, $structKey, $page)
    {
        $pagecount= 0;
        $totalunit= 0;
        
        $server= new TraitConnection();
        $trials= $server->getTrials(urldecode($structKey), urldecode($unit), $page);
        
        $trial= $server->getUnitByGID(urldecode($unit));
        
        $units= $trials->getResponse()->getUnit();
        $first= null;
        
        foreach($trials->getResponse()->getUnit() as $key=>$value){
            foreach($value as $k=>$v){
                
                if($first === null && in_array(Types::kTYPE_ARRAY, $trial->getResponse()->getTag()[$structKey][Tags::kTAG_TYPE])) $first= $v;
                $tag= $server->getUnit($v);
                if($k == Tags::kTAG_UNIT ){
                    $units[$key]['tag']= $tag->getResponse()->getIds()[0];
                    $units[$key]['term']= null;
                    break;
                }else{
                    $units[$key]['tag']= null;
                    $units[$key]['term']= $first;
                }
            }
        }
        
        $pagecount= ceil($trials->getStatus()->getAffectedCount()/$trials->getPaging()->getPageLimit());
        $totalunit= $trials->getStatus()->getAffectedCount();
        
        //var_dump($units);
        //print_r('<pre style="height:200px;overflow: auto;">');
        //print_r($units);
        //print_r('</pre>');
        //print_r('<pre style="height:200px;overflow: auto;">');
        //print_r($trials);
        //print_r('</pre>');

	    //
	    // Remove hidden tags.
	    // MILKO
	    //
	    $tags_list = $trials->getResponse()->getTag();
	    foreach( $units as $k1 => $v1 )
	    {
		    //
		    // Reference unit.
		    //
	        $ref_unit = & $units[ $k1 ];

		    //
		    // Iterate unit tags.
		    //
		    $unit_tags = array_keys( $ref_unit );
		    foreach( $unit_tags as $unit_tag )
		    {
			    if( in_array( Types::kTYPE_HIDDEN, $tags_list[ $unit_tag ] ) )
				    unset( $ref_unit[ $unit_tag ]);
		    }
	    }

        return $this->render(
            'BioversityTraitBundle:Trait:trials_list.html.twig',
            array(
                'trial'      => $trial->getResponse()->getAllResponse(),
                'trials'     => $units,
                'response'   => $trials->getResponse(),
                'tags'       => $tags_list,
                'terms'      => $trials->getResponse()->getTerm(),
                'pagecount'  => $pagecount,
                'actualpage' => $page,
                'totalunit'  => $totalunit,
                'unit'       => $unit,
                'structKey'  => $structKey,
	            'domain_tag' => Tags::kTAG_DOMAIN
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

    private function getFeaturedData($postValue)
    {
        $server= new TraitConnection();
        
        $formData= array();
        
        foreach($postValue as $key=>$value){
            if(is_array($value)){
                foreach($value as $subkey=>$postdata){
                    if($postdata === null || strlen($postdata) === 0 || $postdata == '')
                        unset($postValue[$key][$subkey]);
                        
                    if(count($postValue[$key]) == 0)
                        unset($postValue[$key]);
                }
            }else{
                if($value == null)
                    unset($postValue[$key]);
            }
        }
              
        foreach($postValue as $key=>$value){
            if($key !== '_token' && $key !== 'page'){
                $newKeys= explode('_',$key);
                $lastKey= $newKeys[count($newKeys)-1];
                
                foreach($newKeys as $newKey=>$new){
                    if($lastKey == 'enabler'){
                        $keychild= str_replace('_enabler','',$key);
                        if(array_key_exists($keychild, $postValue)){
                            unset($postValue [$key]);
                        }
                    }
                }
                
            }
        }
        
        foreach($postValue as $key=>$value){
            $newKeys= explode('_',$key);
            $lastKey= $newKeys[count($newKeys)-1];
             
            if(is_array($value)){
                $formData[]= $server->createQuery($lastKey, null, $value);
            }else{
                if($lastKey == 'enabler'){
                    $formData[]= $newKeys[count($newKeys)-2];
                }else{
                    if($lastKey !== 'page'){
                        $formData[]= $server->createQuery($lastKey, null, $value);
                    }
                }
            }
        }
        
        //var_dump($postValue);
        //var_dump($formData);
        //die();
        //return $server->getUnitSummary($formData);
        return $formData;
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