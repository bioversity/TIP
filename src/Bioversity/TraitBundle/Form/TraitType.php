<?php

namespace Bioversity\TraitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class TraitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('trait','text',array('required' => true));
    }

    public function getName()
    {
        return 'TraitSearch';
    }
}