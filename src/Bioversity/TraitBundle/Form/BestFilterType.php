<?php

namespace Bioversity\TraitBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\TraitBundle\Repository\TraitConnection;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;

class BestFilterType extends BioversityBaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	$builder->add('trait','hidden',array('required' => true));
	$builder->add('location', 'choice', array(
	    'choices'   => $this->getLocation($options),
	    'required'  => false,
	    'empty_value' => 'Choose Country',
	));
	$builder->add('species','text',array('required' => false));
	$builder->add('page','text',array('required' => true));
    }

    public function getName()
    {
        return 'BestFilterSearch';
    }
    
    private function getLocation($options)
    {
	if(array_key_exists('trait', $options['data'])){
	    $trait= $options['data']['trait'];
	}else{
	    $trait= null;
	}
	
	$traitConnection= new TraitConnection();
	$serverConnection = new ServerConnection();
	
	$term= $serverConnection->getTagByGID('MCPD:ORIGCTY', Tags::kTAG_GID);
	
	if($trait){
	    $tag= $term[':WS:RESPONSE']['_ids'][0];
	    $type= $term[':WS:RESPONSE']['_tag'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_TYPE][0];
	    $locations= $traitConnection->getLocations($tag, $options['data']['tags']);
	    
	    if($locations[':WS:RESPONSE'])
		return $serverConnection->getDistinctDetail($locations[':WS:RESPONSE'], $type);
	    
	    return array();
	}else{
	    return $this->getOptions($term[':WS:RESPONSE']['_ids'][0]);
	}
    }
}