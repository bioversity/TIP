<?php

namespace Bioversity\SliderBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class SliderSearchNodeType extends BioversityBaseType
{
    var $checkRequiredField= false;
    
    var $internationlization= array(
        Tags::kTAG_GID,
	Tags::kTAG_LABEL,
	Tags::kTAG_SYNONYMS,
	Tags::kTAG_KIND,
	Tags::kTAG_TYPE,
    );

    public function getName()
    {
        return 'SliderSearchNode';
    }
}