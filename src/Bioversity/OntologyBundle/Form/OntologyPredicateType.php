<?php

namespace Bioversity\OntologyBundle\Form;

use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyPredicateType extends BioversityBaseType
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
        return 'OntologyPredicate';
    }
}