<?php

namespace Bioversity\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Choice;

class BioversityGenericUserType extends AbstractType
{

    public function getName()
    {
        return 'BioversityDatasetUser';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fullname', 'text', array('required' => true));
        $builder->add('username', 'text', array('required' => true));
        $builder->add('password', 'text', array('required' => true));
        $builder->add('email', 'email', array('required' => true));
    }
}