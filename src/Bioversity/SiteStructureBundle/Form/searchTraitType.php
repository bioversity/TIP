<?php

namespace Bioversity\SiteStructureBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class searchTraitType extends BioversityBaseType
{
    var $checkRequiredField= false;
    
    var $internationlization= array(
        Tags::kTAG_GID,
	Tags::kTAG_LABEL,
	Tags::kTAG_SYNONYMS
    );

    public function getName()
    {
        return 'SliderSearchNode';
    }
}