<?php

namespace Bioversity\OntologyBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Bioversity\OntologyBundle\Validator\Constraints\ContainsAlphanumeric;
use Bioversity\OntologyBundle\Validator\Constraints\ContainsLID;
use Bioversity\OntologyBundle\Validator\Constraints\ContainsNAMESPACE;
use Bioversity\OntologyBundle\Validator\Constraints\ContainsDEFAULT;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\OntologyBundle\Repository\ServerConnection;

class OntologyBaseType extends AbstractType
{
    public function getName()
    {
        return 'OntologyBase';
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $labels= $this->getLabel();
        $records= $labels[':WS:RESPONSE'];
        $tags= $records['_tag'];
        $terms= $records['_term'];
        
        foreach($this->internationlization as $id){
            $field= $this->getInputType($id, $terms, $tags);                
            $builder->add((string)$id,$field['type'],$field['options']);
        }
        
        if($this->getName()=='OntologyNode'){
            foreach($options['data']['nodes'] as $node){
                $nodeList[]= $node[Tags::kTAG_NID];
            }
            
            if(count($nodeList) > 0)
                $builder->add(
                    'node_related',
                    'choice',
                    array(
                        'choices' => $nodeList,
                        'expanded' => true,
                        'multiple' => false,
                        'required' => false
                    )
                );
        }
    }
    
    //"attr", "block_name", "by_reference", "cascade_validation", "compound", "constraints", "csrf_field_name", "csrf_protection", "csrf_provider", "data", "data_class", "disabled", "empty_data", "error_bubbling", "error_mapping", "extra_fields_message", "intention", "invalid_message", "invalid_message_parameters", "label", "label_attr", "mapped", "max_length", "pattern", "post_max_size_message", "property_path", "read_only", "required", "translation_domain", "trim", "validation_constraint", "validation_groups", "virtual"
    
    public function getValidator($gid, $regex= NULL)
    {
        $class= str_replace(':', 'Bioversity\OntologyBundle\Validator\Constraints\Contains', $gid);
        
        if(class_exists($class))
            return new $class();
        else
            //add check on tag pattern
            return new ContainsDEFAULT();
    }
    
    public function getLabel()
    {
        
        $server= new ServerConnection();
        //print_r($server->getTags($this->internationlization));
        return $server->getTags($this->internationlization);
    }
    
    private function getInputType($id, $terms, $tags)
    {
        $definition= $terms[$tags[$id][Tags::kTAG_PATH][0]][Tags::kTAG_DEFINITION];
        $name= str_replace(' ', '_',$terms[$tags[$id][Tags::kTAG_PATH][0]][Tags::kTAG_LABEL]['en']);
        $required= in_array(':REQUIRED', $tags[$id][Tags::kTAG_TYPE]);
        
        $constraints= array($this->getValidator($tags[$id][Tags::kTAG_GID]));
        
        if($required)
            $constraints[]= new NotBlank();        
        
        $defaultOptions= array(
            'required' => $required,
            'label' => $name,
            'attr' => array('title' => $this->getAttrTitle($definition) ),
            'constraints' => $constraints
        );
            
        if(array_key_exists(Tags::kTAG_INPUT, $tags[$id]))
            $inputType= $tags[$id][Tags::kTAG_INPUT];
        else
            $inputType= 'INPUT-HIDDEN';
        
        switch($inputType){
            case ':INPUT-TEXTAREA':
                return array(
                    'type'      => 'textarea',
                    'options'   => $defaultOptions);
            
            case ':INPUT-TEXT':
                return array(
                    'type'      => 'text',
                    'options'   => $defaultOptions);
            
            case ':INPUT-MULTIPLE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['expanded'] = true;
                    $defaultOptions['multiple'] = true;
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions);
                    
            case ':INPUT-CHOICE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['expanded'] = false;
                    $defaultOptions['multiple'] = false;
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions);
                
            case 'INPUT-HIDDEN':
                return array(
                    'type'      => 'hidden',
                    'options'   => $defaultOptions);
        }
    }
    
    private function getOptions($id)
    {
        $server= new ServerConnection();
        //print_r($server->getEnumOptions($id));
        $optionsList= $server->getEnumOptions($id);
        foreach($optionsList as $option){
            
        }
        return array('primo');
    }
    
    public function getAttrTitle($definitions)
    {
        $title= '';
        foreach($definitions as $key=>$definition){
            $title = $title.'<p style="text-align:left;"><strong>'.$key.'</strong>:'.$definition.'</p>';
        }
        
        return $title;
    }
    
}