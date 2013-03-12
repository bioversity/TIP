<?php

namespace Bioversity\SecurityBundle\Form;

use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class BioversityUserRegistrationType extends BioversityBaseType
{

    public function getName()
    {
        return 'BioversityUser';
    }
    
    var $internationlization= array(
        Tags::kTAG_USER_NAME,
        Tags::kTAG_USER_CODE,
        Tags::kTAG_USER_PASS,
        Tags::kTAG_USER_MAIL,
        Tags::kTAG_USER_INSTITUTE_CODE,
        Tags::kTAG_USER_INSTITUTE_NAME,
        Tags::kTAG_USER_INSTITUTE_ADDRESS,
        Tags::kTAG_USER_INSTITUTE_COUNTRY
    );
    
    public function getFields(){
        return $this->internationlization;
    }
}