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
        $word = json_decode(stripslashes($_POST['word']));
        
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
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $server= new TraitConnection();
        
        $formData= array();
        
        foreach($_POST as $key=>$value){
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
        
        $units= $server->getUnits($formData, $_POST['page']);
        
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            print_r('<pre style="height:200px;overflow: auto;">');
            print_r($units);
            print_r('</pre>');
        }
        
        $data= array();
        $pagecount= 0;
        $totalunit= 0;
        
        if($units){
            $pagecount= ceil($units[':WS:STATUS'][':WS:AFFECTED-COUNT']/$units[':WS:PAGING'][':WS:PAGE-LIMIT']);
            $totalunit= $units[':WS:STATUS'][':WS:AFFECTED-COUNT'];
            
            if(array_key_exists(':WS:RESPONSE',$units)){
                $data= $units[':WS:RESPONSE'];
            }else{
                $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found') );
            }
        }
        
        //TODO. use this to check the request type
        //print_r($request->isXmlHttpRequest());
        return $this->render(
            'BioversityTraitBundle:Trait:unit_list.html.twig',
            array(
                'datalist'      => $data,
                'pagecount'     => $pagecount,
                'actualpage'    => $_POST['page'],
                'totalunit'     => $totalunit,
                'errors'        => $session->getFlashBag()->get('error')
            ));
    }
    
    public function jsonGetTrialAction(Request $request, $unit, $structKey, $page)
    {
        //$unit = json_decode(stripslashes($_POST['unit']));
        
        $pagecount= 0;
        $totalunit= 0;
        
        $server= new TraitConnection();
        $trials= $server->getTrials(urldecode($structKey), urldecode($unit), $page);
        
        //print_r($trials);
        
        foreach($trials[':WS:RESPONSE']['_unit'] as $key=>$value){
            foreach($value as $k=>$v){
                if($k == Tags::kTAG_UNIT ){
                    $tag= $server->getUnit($v);
                    $trials[':WS:RESPONSE']['_unit'][$key]['tag']= $tag[':WS:RESPONSE']['_ids'][0];
                    break;
                }else{
                    $trials[':WS:RESPONSE']['_unit'][$key]['tag']= null;
                }
            }
        }
        
        $pagecount= ceil($trials[':WS:STATUS'][':WS:AFFECTED-COUNT']/$trials[':WS:PAGING'][':WS:PAGE-LIMIT']);
        $totalunit= $trials[':WS:STATUS'][':WS:AFFECTED-COUNT'];
        
        //print_r($trials[':WS:RESPONSE']['_unit']);
        
        return $this->render(
            'BioversityTraitBundle:Trait:trials_list.html.twig',
            array(
                'trials'     => $trials[':WS:RESPONSE']['_unit'],
                'responce'   => $trials[':WS:RESPONSE'],
                'pagecount'  => $pagecount,
                'actualpage' => $page,
                'totalunit'  => $totalunit,
                'unit'       => $unit,
                'structKey'  => $structKey
            ));
    }
    
    public function jsonGetTrialDetailAction(Request $request, $unit)
    {
        //$unit = json_decode(stripslashes($_POST['unit']));
        
        $server= new TraitConnection();
        $trial= $server->getUnitByGID(urldecode($unit));
        
        return $this->render(
            'BioversityTraitBundle:Trait:more_detail_page.html.twig',
            array(
                'data'       => $trial[':WS:RESPONSE']['_unit'][urldecode($unit)],
                'datalist'   => $trial[':WS:RESPONSE'],
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



//array(
//  '$AND' => array(
//        array(
//            '$OR' => array(
//                array(
//                    '$AND' => array(
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "40",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                            kOFFSET_QUERY_TYPE => kTYPE_INT,
//                            kOFFSET_QUERY_DATA => 218
//                        ),
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "218",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                            kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                            kOFFSET_QUERY_DATA => array('MCPD:SAMPSTAT:100', 'MCPD:SAMPSTAT:200','MCPD:SAMPSTAT:300')
//                        )
//                    )
//                ),
//                array(
//                    '$AND' => array(
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "40",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                            kOFFSET_QUERY_TYPE => kTYPE_INT,
//                            kOFFSET_QUERY_DATA => 220
//                        ),
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "220",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                            kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                            kOFFSET_QUERY_DATA => array('MCPD:COLLSRC:10', 'MCPD:COLLSRC:20', 'MCPD:COLLSRC:30')
//                        )
//                    )
//                )
//            )
//        ),
//        array(
//            '$OR' => array(
//                array(
//                  '$AND' => array(
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "40",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                            kOFFSET_QUERY_TYPE => kTYPE_INT,
//                            kOFFSET_QUERY_DATA => 211),
//                        array(
//                            kOFFSET_QUERY_SUBJECT => "211",
//                            kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                            kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                            kOFFSET_QUERY_DATA => array('ISO:3166:1:alpha-3:CIV')
//                        )
//                    )
//                )
//            )
//        )
//    )
//);

//$query = array
//(
//      '$AND' => array
//        (
//                //
//                // Gruppo 1.
//                //
//                array
//                (
//                        '$OR' => array
//                        (
//                                //
//                                // Gruppo 1 elemento 1.
//                                //
//                                array
//                                (
//                                        '$AND' => array
//                                        (
//                                                array
//                                                (
//                                                        kOFFSET_QUERY_SUBJECT => "40",
//                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                                                        kOFFSET_QUERY_TYPE => kTYPE_INT,
//                                                        kOFFSET_QUERY_DATA => 218
//                                                ),
//                                                array
//                                                (
//                                                        '$OR' => array
//                                                        (
//                                                                array
//                                                                (
//                                                                        kOFFSET_QUERY_SUBJECT => "218",
//                                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                                                                        kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                                                                        kOFFSET_QUERY_DATA => array
//                                                                        (
//                                                                                'MCPD:SAMPSTAT:100',
//                                                                                'MCPD:SAMPSTAT:200',
//                                                                                'MCPD:SAMPSTAT:300'
//                                                                        )
//                                                                ),
//                                                                array
//                                                                (
//                                                                        kOFFSET_QUERY_SUBJECT => "1360.218",
//                                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                                                                        kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                                                                        kOFFSET_QUERY_DATA => array
//                                                                        (
//                                                                                'MCPD:SAMPSTAT:100',
//                                                                                'MCPD:SAMPSTAT:200',
//                                                                                'MCPD:SAMPSTAT:300'
//                                                                        )
//                                                                )
//                                                        )
//                                                ),
//                                        )
//                                ),
//                                //
//                                // Gruppo 1 elemento 2.
//                                //
//                                array
//                                (
//                                        '$AND' => array
//                                        (
//                                                array
//                                                (
//                                                        kOFFSET_QUERY_SUBJECT => "40",
//                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                                                        kOFFSET_QUERY_TYPE => kTYPE_INT,
//                                                        kOFFSET_QUERY_DATA => 220
//                                                ),
//                                                array
//                                                (
//                                                        '$OR' => array
//                                                        (
//                                                                array
//                                                                (
//                                                                        kOFFSET_QUERY_SUBJECT => "220",
//                                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                                                                        kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                                                                        kOFFSET_QUERY_DATA => array
//                                                                        (
//                                                                                'MCPD:COLLSRC:10',
//                                                                                'MCPD:COLLSRC:20',
//                                                                                'MCPD:COLLSRC:30'
//                                                                        )
//                                                                ),
//                                                                array
//                                                                (
//                                                                        kOFFSET_QUERY_SUBJECT => "130.220",
//                                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                                                                        kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                                                                        kOFFSET_QUERY_DATA => array
//                                                                        (
//                                                                                'MCPD:COLLSRC:10',
//                                                                                'MCPD:COLLSRC:20',
//                                                                                'MCPD:COLLSRC:30'
//                                                                        )
//                                                                )
//                                                        )
//                                                )
//                                        )
//                                )
//                        )
//                ),
//                //
//                // Gruppo 2.
//                //
//                array
//                (
//                        '$OR' => array
//                        (
//                                //
//                                // Gruppo 2 elemento 1.
//                                //
//                                array
//                                (
//                                        '$AND' => array
//                                        (
//                                                array
//                                                (
//                                                        kOFFSET_QUERY_SUBJECT => "40",
//                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_EQUAL,
//                                                        kOFFSET_QUERY_TYPE => kTYPE_INT,
//                                                        kOFFSET_QUERY_DATA => 211
//                                                ),
//                                                array
//                                                (
//                                                        '$OR' => array
//                                                        (
//                                                                array
//                                                                (
//                                                                        kOFFSET_QUERY_SUBJECT => "211",
//                                                                        kOFFSET_QUERY_OPERATOR => kOPERATOR_IN,
//                                                                        kOFFSET_QUERY_TYPE => kTYPE_STRING,
//                                                                        kOFFSET_QUERY_DATA => array
//                                                                        (
//                                                                                'ISO:3166:1:alpha-3:CIV'
//                                                                        )
//                                                                )
//                                                        )
//                                                )
//                                        )
//                                )
//                        )
//                )
//        )
//);
//
