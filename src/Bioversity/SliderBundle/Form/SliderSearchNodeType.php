<?php

namespace Bioversity\SliderBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class SliderSearchNodeType extends BioversityBaseType
{
    public function __construct()
    {
        $internationalization= array(
				    Tags::kTAG_GID,
				    Tags::kTAG_LABEL,
				    Tags::kTAG_SYNONYMS,
				    Tags::kTAG_KIND,
				    Tags::kTAG_TYPE,
				);
        
        $this->setInternationlization($internationalization);
	$this->setCheckRequiredField(false);
    }

    public function getName()
    {
        return 'SliderSearchNode';
    }
}