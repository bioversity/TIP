<?php

namespace Bioversity\OntologyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\OntologyBundle\Repository\ServerConnection;

class OntologyTermType extends AbstractType
{
    var $label= array(
        'code' => 'text',
        'namespace' => 'text',
        'label' => 'text',
        'description' => 'textarea'
    );
    
    public function getName()
    {
        return 'OntologyTerm';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $labels= $this->getLabel();
        
        foreach($labels as $label => $type){
            foreach($labels[':WS:RESPONSE']['_ids'] as $value){
            $builder->add(
                str_replace(' ', '_',$labels[':WS:RESPONSE']['_term'][$labels[':WS:RESPONSE']['_tag'][$value][Tags::kTAG_PATH][0]][Tags::kTAG_LABEL]['en']),
                'text',
                array('required' => true));
            }
        }
    }
    
    public function getLabel()
    {
        $internationlization= array(
            (int) Tags::kTAG_LID,
            (int) Tags::kTAG_NAMESPACE,
            (int) Tags::kTAG_LABEL,
            (int) Tags::kTAG_DEFINITION
        );
        
        $server= new ServerConnection();
        return $server->getTags($internationlization);
    }
}