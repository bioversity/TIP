<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;

class InputType
{
    var $input;
    
    public function __construct($tag)
    {
        if(array_key_exists(Tags::kTAG_INPUT, $tag)){
            $this->input=  $tag[Tags::kTAG_INPUT];
        }else if(array_key_exists(Tags::kTAG_TYPE, $tag)){
            $this->input= $this->findInputType($tag[Tags::kTAG_TYPE]);
        }
        
    }
    
    public function getInputType()
    {
        return $this->input;
    }
    
    public function setInputType($input)
    {
        $this->input= $input;
    }
    
    private function findInputType($type)
    {
        if(in_array(':SET',$type))
            return ':INPUT-MULTIPLE';
            
        if(in_array(':LSTRING',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':SVG',$type))
            return ':INPUT-FILE';
            
        if(in_array(':META',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-UNIT',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-USER',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-TAG',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-NODE',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-EDGE',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REF-TERM',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':INT64',$type))
            return ':INPUT-RANGE';
            
        if(in_array(':INT32',$type))
            return ':INPUT-RANGE';
            
        if(in_array(':URL',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':REGEX',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':TIME',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':DATE',$type))
            return ':INPUT-DATE';
            
        if(in_array(':BOOLEAN',$type))
            return ':INPUT-RADIO';
            
        if(in_array(':FLOAT',$type))
            return ':INPUT-RANGE';
            
        if(in_array(':INT',$type))
            return ':INPUT-RANGE';
            
        if(in_array(':STRING',$type))
            return ':INPUT-TEXT';
            
        if(in_array(':ENUM',$type))
            return ':INPUT-MULTIPLE-CHOICE';
            
        if(in_array(':TEXT',$type))
            return ':INPUT-TEXTAREA';
            
        if(in_array(':FLOAT',$type))
            return ':INPUT-TEXT';
            
        return 'INPUT-HIDDEN';
    }
}