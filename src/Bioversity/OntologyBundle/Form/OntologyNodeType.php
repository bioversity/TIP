<?php

namespace Bioversity\OntologyBundle\Form;

use Bioversity\OntologyBundle\Form\OntologyBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyNodeType extends OntologyBaseType
{  
    var $internationlization= array(
        //(int) Tags::kTAG_TERM,
        Tags::kTAG_PID,
	Tags::kTAG_KIND,	
	Tags::kTAG_TYPE,
	Tags::kTAG_INPUT,
        Tags::kTAG_CATEGORY,
	Tags::kTAG_PATTERN,
	Tags::kTAG_LENGTH,	
	Tags::kTAG_MIN_VAL,	
	Tags::kTAG_MAX_VAL,
        Tags::kTAG_DESCRIPTION,
	Tags::kTAG_EXAMPLES,
    );

    public function getName()
    {
        return 'OntologyNode';
    }
}