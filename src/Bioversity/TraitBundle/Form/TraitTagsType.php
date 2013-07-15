<?php

namespace Bioversity\TraitBundle\Form;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class TraitTagsType extends BioversityBaseType
{
    public function getName()
    {
        return '';
    }
    
    public function __construct(ServerResponseManager $traits)
    {
        $response= $traits->getResponse();
        $tags= $response->getTag();
        $ids= $response->getIds();
        $synonyms= '';
        $internationalization= array();
        foreach($ids as $key=>$id){
            $origin= $tags[$id][Tags::kTAG_PATH][0];
            if(array_key_exists(Tags::kTAG_OFFSETS, $tags[$id]))
                $synonyms= $this->getTagsString($id, $tags[$id][Tags::kTAG_OFFSETS]);
                
            $internationalization[]= str_replace(':','',$origin).'_'.$synonyms.$id;
        }
        
        $this->setInternationlization($internationalization);
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