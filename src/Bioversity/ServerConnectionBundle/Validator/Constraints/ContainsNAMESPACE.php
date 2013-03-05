<?php

namespace Bioversity\ServerConnectionBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsNAMESPACE extends Constraint
{
    public $message = 'The NAMESPACE %string% don\'t exist yet. You need to create it before to use';
}