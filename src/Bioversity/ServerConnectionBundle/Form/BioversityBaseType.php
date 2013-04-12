<?php

namespace Bioversity\ServerConnectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsAlphanumeric;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsLID;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsNAMESPACE;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsDEFAULT;

class BioversityBaseType extends AbstractType
{
    var $checkRequiredField= true;
    
    public function getName()
    {
        return 'BioversityBase';
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $labels= $this->getLabel();
        $records= $labels[':WS:RESPONSE'];
        $tags= $records['_tag'];
        $terms= $records['_term'];       
        
        foreach($this->internationlization as $id){
            $tag= $id;
            if(strpos($id,'_') !== false){
                $idArray= explode('_', $id);
                $tag= $idArray[count($idArray)-1];
            }
            $field= $this->getInputType($tag, $terms, $tags);                
            $builder->add((string)$id,$field['type'],$field['options']);
        }
    }
    
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
        $tags= $this->clearTags($this->internationlization);
        return $server->getTags($tags);
    }
    
    private function getInputType($id, $terms, $tags)
    {
        $definition=
            (array_key_exists(Tags::kTAG_DEFINITION, $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]]))?
                $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]][Tags::kTAG_DEFINITION] :
                null;
        
        //strange behaviour in mane generation, it don't work on _
        $name= $this->getFieldName($terms, $tags, $id);
        
        if($this->checkRequiredField)
            $required= in_array(':REQUIRED', $tags[$id][Tags::kTAG_TYPE]);
        else
            $required= false;
        
        $constraints= array($this->getValidator($tags[$id][Tags::kTAG_GID]));
        
        if($required)
            $constraints[]= new NotBlank();        
        
        $defaultOptions= array(
            'required' => $required,
            'label' => $name,
            'attr' => array('title' => $this->getAttrTitle($definition) ),
            'constraints' => $constraints
        );
        
        $inputType= 'INPUT-HIDDEN';
        
        //print_r($tags[$id]);
        if(array_key_exists(Tags::kTAG_INPUT, $tags[$id])){
            $inputType= $tags[$id][Tags::kTAG_INPUT];
        }else if(array_key_exists(Tags::kTAG_TYPE, $tags[$id])){
            switch($tags[$id][Tags::kTAG_TYPE][0]){
                case ':ENUM':
                    $inputType= ':INPUT-MULTIPLE-CHOICE';
                    break;
                case ':TEXT':
                    $inputType= ':INPUT-TEXT';
                    break;
                case ':FLOAT':
                    $inputType= ':INPUT-TEXT';
                    break;
            }
        }
        
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
            
            case ':INPUT-MULTIPLE-CHOICE':
                    $defaultOptions['choices'] = $this->getOptions($id);
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
    
    public function getOptions($id)
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
                //$options[]= array($nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_GID] => $spacer.$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_LABEL]['en']);
                $options[$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_GID]]= $spacer.$nodes[$option[Tags::kTAG_SUBJECT]][Tags::kTAG_LABEL]['en'];
                $options[]= $this->cicleOptions($edges, $nodes, $option[Tags::kTAG_SUBJECT],$levels+1);
            }
        }
        
        //var_dump($options);
        return $options;
    }
    
    public function getAttrTitle($definitions= null)
    {
        $title= '';
        if($definitions)
            foreach($definitions as $key=>$definition){
                $title = $title.'<p style="text-align:left;"><strong>'.$key.'</strong>:'.$definition.'</p>';
            }
        
        return $title;
    }
    
    public function getFieldName($terms, $tags, $id)
    {
        $name= ' <br/> '.'<i>'.str_replace(' ', ' ', $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]][Tags::kTAG_LABEL]['en']).'</i>';
        
        if(count($tags[$id][Tags::kTAG_PATH]) > 1)
            $name= '<strong>'.str_replace(' ', ' ',$terms[$tags[$id][Tags::kTAG_PATH][0]][Tags::kTAG_LABEL]['en']).'</strong>'.$name;
            
        return $name;
    }
    
    public function clearTags($tags)
    {
        foreach($tags as $key=>$tag){
            if(strpos($tag,'_') !== false){
                $tagArray= explode('_', $tag);
                $tags[$key]= $tagArray[count($tagArray)-1];
            }
        }
        
        return $tags;
    }
    
}