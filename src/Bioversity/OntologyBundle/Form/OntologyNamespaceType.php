<?php

namespace Bioversity\OntologyBundle\Form;

use Bioversity\OntologyBundle\Form\OntologyBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyNamespaceType extends OntologyBaseType
{   
    var $internationlization= array(
        //(int) Tags::kTAG_TERM,
        Tags::kTAG_NAMESPACE,
        Tags::kTAG_LID,
        Tags::kTAG_LABEL,
        Tags::kTAG_DEFINITION,
        Tags::kTAG_SYNONYMS,
        Tags::kTAG_CATEGORY
    );
    
    public function getName()
    {
        return 'OntologyNamespace';
    }
}