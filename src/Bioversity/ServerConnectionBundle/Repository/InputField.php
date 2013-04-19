<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;

class InputField
{
    public function getInputField($id, $inputType, $defaultOptions)
    {        
        switch($inputType){
            case ':INPUT-RANGE':
                $defaultOptions['attr']['class'] = 'range_field';
                return array(
                    'type'      => 'text',
                    'options'   => $defaultOptions,
                    //'field_type'=> $inputType
                    );
            
            case ':INPUT-TEXTAREA':
                return array(
                    'type'      => 'textarea',
                    'options'   => $defaultOptions,
                    //'field_type'=> $inputType
                    );
            
            case ':INPUT-TEXT':
                return array(
                    'type'      => 'text',
                    'options'   => $defaultOptions,
                    //'field_type'=> $inputType
                    );
            
            case ':INPUT-MULTIPLE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['expanded'] = true;
                    $defaultOptions['multiple'] = true;
                    $defaultOptions['attr']['class'] = 'tree';
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions,
                        //'field_type'=> $inputType
                    );
            
            case ':INPUT-MULTIPLE-CHOICE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['multiple'] = true;
                    $defaultOptions['attr']['class'] = 'tree';
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions,
                        //'field_type'=> $inputType
                        );
                    
            case ':INPUT-CHOICE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['expanded'] = false;
                    $defaultOptions['multiple'] = false;
                    $defaultOptions['empty_value'] = 'Choice value';
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions,
                        //'field_type'=> $inputType
                        );
                
            case 'INPUT-HIDDEN':
                return array(
                    'type'      => 'hidden',
                    'options'   => $defaultOptions,
                    //'field_type'=> $inputType
                    );
        }
    }
    
    public function getOptions($id)
    {
        $server= new ServerConnection();
        $optionsList= $server->getEnumOptions($id);
        
        return $this->buildOptions($optionsList);
    }
    
    private function buildOptions($optionsList)
    {
        $levels= 1;
        $options= array();
        
        if(array_key_exists(':WS:RESPONSE', $optionsList)){
            $response= $optionsList[':WS:RESPONSE'];
            $edges= $response['_edge'];
            $nodes= $response['_node'];
            $node= $response['_ids'][0];
            
            $options= $this->cicleOptions($edges, $nodes, $node, $levels);
        }
        
        return $options;
    }
    
    private function cicleOptions($edges, $nodes, $node, $levels=1)
    {
        $options= array();
        $spacer= '';
        if($levels > 1){
            for($i=1; $i<$levels; $i++){
                $spacer=$spacer.'___';
            }
            
        }
        foreach($edges as $option){
            if($option[Tags::kTAG_OBJECT] == $node){
                //var_dump($option[Tags::kTAG_OBJECT].'->'.$option[Tags::kTAG_SUBJECT].'<br/>');
                //$options[]= array($nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_GID] => $spacer.$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_LABEL]['en']);
                $options[$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_GID]]= $spacer.$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_LABEL]['en'];
                $options[]= $this->cicleOptions($edges, $nodes, $option[Tags::kTAG_SUBJECT],$levels+1);
            }
        }
        
        //var_dump($options);
        return $options;
    }
    
}