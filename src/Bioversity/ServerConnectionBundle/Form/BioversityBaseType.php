<?php

namespace Bioversity\ServerConnectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\InputType;
use Bioversity\ServerConnectionBundle\Repository\InputField;
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
        
        //strange behaviour in name generation, it don't work on _
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
            
        //move this method in defaultOptionClass
        if(array_key_exists(Tags::kTAG_MIN_VAL, $tags[$id]))
            $defaultOptions['attr']['minval']= $tags[$id][Tags::kTAG_MIN_VAL];
            
        if(array_key_exists(Tags::kTAG_MAX_VAL, $tags[$id]))
            $defaultOptions['attr']['maxval']= $tags[$id][Tags::kTAG_MAX_VAL];
        
        $inputTypeModel= new InputType($tags[$id]);
        $inputFieldModel= new InputField();
        $inputType= $inputTypeModel->getInputType();
        
        return $inputFieldModel->getInputField($id, $inputType, $defaultOptions);
    }
    
    public function getAttrTitle($definitions= null)
    {
        $title= '';
        if($definitions)
            foreach($definitions as $key=>$definition){
                //$title = $title.'<p style="text-align:left;"><strong>'.$key.'</strong>:'.$definition.'</p>';
                $title = $title.$definition;
            }
        
        return $title;
    }
    
    public function getFieldName($terms, $tags, $id)
    {
        $name= '<i>'.str_replace(' ', ' ', $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]][Tags::kTAG_LABEL]['en']).'</i>';
        
        if(count($tags[$id][Tags::kTAG_PATH]) > 1){
            $name= '<strong>'.str_replace(' ', ' ',$terms[$tags[$id][Tags::kTAG_PATH][0]][Tags::kTAG_LABEL]['en']).'</strong>'.' <br/> '.$name;
        }else{
            $name= '<strong>'.$name.'</strong>';
        }
        
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