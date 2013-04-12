<?php

namespace Bioversity\TraitBundle\Form;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;

class TraitTagsType extends BioversityBaseType
{
    var $internationlization= array();
    
    public function getName()
    {
        return '';
    }
    
    public function __construct($traits)
    {
        $server= new ServerConnection();
        
        $response= $traits[':WS:RESPONSE'];
        $tags= $response['_tag'];
        $ids= $response['_ids'];
        $synonyms= '';
        foreach($ids as $key=>$id){
            $origin= $tags[$id][Tags::kTAG_PATH][0];
            if(array_key_exists(Tags::kTAG_OFFSETS, $tags[$id]))
                $synonyms= $this->getTagsString($id, $tags[$id][Tags::kTAG_OFFSETS]);
                
            $this->internationlization[]= str_replace(':','',$origin).'_'.$synonyms.$id;
        }
    }
    
    public function getTagsString($id, $tags= null)
    {
        $string= '';
        foreach($tags as $tag)
        {
            if($tag != $id)
                $string .= str_replace('.',':',$tag).'_';
        }
        
        return $string;
    }
}