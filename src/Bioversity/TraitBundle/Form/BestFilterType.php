<?php

namespace Bioversity\TraitBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;

class BestFilterType extends BioversityBaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('trait','hidden',array('required' => true));
	$builder->add('location', 'choice', array(
	    'choices'   => $this->getLocation(),
	    'required'  => false,
	));
	//$builder->add('species','text',array('required' => false));
	$builder->add('page','text',array('required' => true));
    }

    public function getName()
    {
        return 'BestFilterSearch';
    }
    
    private function getLocation()
    {
	$server= new ServerConnection();
	$term= $server->getTerm('MCPD:ORIGCTY');
	
	return $this->getOptions($term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_FEATURES][0]);
    }
}