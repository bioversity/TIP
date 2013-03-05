<?php

namespace Bioversity\OntologyBundle\Form;

//use Bioversity\OntologyBundle\Form\OntologyBaseType;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyNamespaceType extends BioversityBaseType
{   
    public function getName()
    {
        return 'OntologyNamespace';
    }
    
    var $internationlization= array(
        Tags::kTAG_NAMESPACE,
        Tags::kTAG_LID,
        Tags::kTAG_LABEL,
        Tags::kTAG_DEFINITION,
        Tags::kTAG_SYNONYMS,
        Tags::kTAG_CATEGORY
    );
}