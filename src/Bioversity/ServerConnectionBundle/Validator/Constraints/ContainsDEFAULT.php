<?php

namespace Bioversity\ServerConnectionBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsDEFAULT extends Constraint
{
    public $message = 'no validation needed';
}