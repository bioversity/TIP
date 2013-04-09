<?php

namespace Bioversity\TraitBundle\Form;

use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;

class TraitTagsType extends BioversityBaseType
{   
    public function getName()
    {
        return 'TraitTags';
    }
    
    var $internationlization= array();
    
    public function __construct($tags)
    {
        foreach($tags as $key=>$tag)
            $this->internationlization[]= $tag;
    }
}