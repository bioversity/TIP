<?php

namespace Bioversity\OntologyBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsLID extends Constraint
{
    public $message = 'The string "%string%" contains an illegal character: it can\'t contain ":" or "." characters';
}