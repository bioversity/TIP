<?php

namespace Bioversity\OntologyBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsLIDValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (preg_match('/[\:\.]/', $value, $matches)) {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}