<?php

namespace Bioversity\ServerConnectionBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;

class ContainsNAMESPACEValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($value){
            $saver= new ServerConnection();
            $term= $saver->getNamespace($value);
            
            if($term[':WS:STATUS'][':WS:AFFECTED-COUNT'] === 0){
                $this->context->addViolation($constraint->message, array('%string%' => $value));
            }
        }
    }
}