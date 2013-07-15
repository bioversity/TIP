<?php

namespace Bioversity\OntologyBundle\Form;

use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyPredicateType extends BioversityBaseType
{
    public function getName()
    {
        return 'OntologyPredicate';
    }
    
    public function __construct()
    {
        $internationalization= array(
                                    Tags::kTAG_NAMESPACE,
                                    Tags::kTAG_LID,
                                    Tags::kTAG_LABEL,
                                    Tags::kTAG_DEFINITION,
                                    Tags::kTAG_SYNONYMS,
                                    Tags::kTAG_CATEGORY
				);
        
        $this->setInternationlization($internationalization);
    }
}