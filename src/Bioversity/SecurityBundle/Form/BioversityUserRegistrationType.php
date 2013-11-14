<?php

namespace Bioversity\SecurityBundle\Form;

use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class BioversityUserRegistrationType extends BioversityBaseType
{

    public function getName()
    {
        return 'BioversityUserRegistration';
    }
     
    public function __construct()
    {
        $internationalization= array(
				    Tags::kTAG_NAME,
                    Tags::kTAG_USER_CODE,
			        Tags::kTAG_USER_PASS,
					Tags::kTAG_EMAIL,
					Tags::kTAG_NATIONALITY
				);
        
        $this->setInternationlization($internationalization);
    }

    public function getFields(){
        return $this->internationlization;
    }
}