<?php

namespace Bioversity\OntologyBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsLABEL extends Constraint
{
    public $message = 'The NAMESPACE %string% don\'t exist yet. You need to create it before to use';
}