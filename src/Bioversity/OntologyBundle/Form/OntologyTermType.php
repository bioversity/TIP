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
            $records= $labels[':WS:RESPONSE'];
            $tags= $records['_tag'];
            $terms= $records['_term'];
            foreach($records['_ids'] as $id){
                $name= str_replace(' ', '_',$terms[$tags[$id][Tags::kTAG_PATH][0]][Tags::kTAG_LABEL]['en']);
                
                $builder->add(
                    (string)$id,
                    $this->getInputType($id, $tags)/*'text'*/,
                    array('required' => true,'label' => $name)
                );
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
        //print_r($server->getTags($internationlization));
        return $server->getTags($internationlization);
    }
    
    private function getInputType($id, $tags)
    {
        $inputType= $tags[$id][Tags::kTAG_INPUT][0];
        
        switch($inputType){
            case ':INPUT-TEXTAREA':
                return 'textarea';
            case ':INPUT-TEXT':
                return 'text';
        }
    }
}