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
        
        $nodeList= array();
        $this->manageNodeFormException($nodeList, $builder);
    }
    
    public function manageNodeFormException($nodeList, $builder)
    {
        if($this->getName()=='OntologyNode'){
            foreach($options['data']['nodes'] as $node){
                $nodeList[]= array($node[Tags::kTAG_NID]=>$node[Tags::kTAG_NID]);
            }
            
            if(count($nodeList) > 0){
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
                
                $builder->add(
                    'node_class',
                    'hidden',
                    array(
                        'data' => 'COntologyMasterVertex'
                    )
                );
            }else{                
                $builder->add(
                    'node_class',
                    'hidden',
                    array(
                        'data' => 'COntologyAliasVertex'
                    )
                );
            }
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
                    $defaultOptions['attr']['class'] = 'tree';
                    return array(
                        'type'      => 'choice',
                        'options'   => $defaultOptions);
                    
            case ':INPUT-CHOICE':
                    $defaultOptions['choices'] = $this->getOptions($id);
                    $defaultOptions['expanded'] = false;
                    $defaultOptions['multiple'] = false;
                    $defaultOptions['empty_value'] = 'Choice value';
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
        $optionsList= $server->getEnumOptions($id);
        
        return $this->buildOptions($optionsList);
    }
    
    private function buildOptions($optionsList)
    {
        $levels= 1;
        $options= array();
        
        if(array_key_exists(':WS:RESPONSE', $optionsList)){
            $response= $optionsList[':WS:RESPONSE'];
            $edges= $response['_edge'];
            $nodes= $response['_node'];
            $node= $response['_ids'][0];
            
            $options= $this->cicleOptions($edges, $nodes, $node, $levels);
        }
        
        return $options;
    }
    
    private function cicleOptions($edges, $nodes, $node, $levels=1)
    {
        $options= array();
        $spacer= '';
        if($levels > 1){
            for($i=1; $i<$levels; $i++){
                $spacer=$spacer.'___';
            }
            
        }
        foreach($edges as $option){
            if($option[Tags::kTAG_OBJECT] == $node){
                //var_dump($option[Tags::kTAG_OBJECT].'->'.$option[Tags::kTAG_SUBJECT].'<br/>');
                $options[]= $spacer.$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_LABEL]['en'];
                $options[]= $this->cicleOptions($edges, $nodes, $option[Tags::kTAG_SUBJECT],$levels+1);
            }
        }
        
        //var_dump($options);
        return $options;
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