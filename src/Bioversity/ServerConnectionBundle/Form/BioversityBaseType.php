<?php

namespace Bioversity\ServerConnectionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\InputType;
use Bioversity\ServerConnectionBundle\Repository\InputField;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsAlphanumeric;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsLID;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsNAMESPACE;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsDEFAULT;

class BioversityBaseType extends AbstractType
{
    private $checkRequiredField= true;
    private $internationlization;
    private $validatorPath= 'Bioversity\OntologyBundle\Validator\Constraints\Contains';
    
    public function getName()
    {
        return 'BioversityBase';
    }
    
    public function setCheckRequiredField($bool)
    {
        $this->checkRequiredField= $bool;
    }
    
    public function getCheckRequiredField()
    {
        return $this->checkRequiredField;
    }
    
    public function setValidatorPath($path)
    {
        $this->validatorPath= $path;
    }
    
    public function getValidatorPath()
    {
        return $this->validatorPath;
    }
    
    public function getInternationlization()
    {
        return $this->internationlization;
    }
    
    public function setInternationlization($fields)
    {
        $this->internationlization= $fields;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $labels= $this->getLabel();
        $tags= $labels->getResponse()->getTag();
        $terms= $labels->getResponse()->getTerm();       
        
        foreach($this->internationlization as $tag){
            $field= $this->getInputType($tag, $terms, $tags);
                
            $builder->add((string)$tag,$field['type'],$field['options']);
        }
    }
    
    public function getValidator($gid, $regex= NULL)
    {
        $class= str_replace(':', $this->validatorPath, $gid);
        
        if(class_exists($class))
            return new $class();
        else
            //add check on tag pattern
            return new ContainsDEFAULT();
    }
    
    public function getLabel()
    {
        $tags= $this->clearTags($this->internationlization);
        
        $requestManager= new ServerRequestManager();
        $requestManager->setDatabase($requestManager->getDatabaseOntology());
        $requestManager->setOperation('WS:OP:GetTag');
        $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
        
        return $requestManager->sendRequest();
    }
    
    private function getInputType($tag, $terms, $tags)
    {
        $id= $this->clearTag($tag);
            
        $defaultOptions= $this->setOptions($terms, $tags, $id);
        
        $inputTypeModel= new InputType($tags[$id]);
        $inputType= $inputTypeModel->getInputType();
        
        $inputFieldModel= new InputField();
        
        return $inputFieldModel->getInputField($id, $inputType, $defaultOptions);
    }
    
    public function setOptions($terms, $tags, $id)
    {
        $name= $this->getFieldName($terms, $tags, $id);
        
        $definition=
            (array_key_exists(Tags::kTAG_DEFINITION, $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]]))?
                $terms[$tags[$id][Tags::kTAG_PATH][count($tags[$id][Tags::kTAG_PATH])-1]][Tags::kTAG_DEFINITION] :
                null;
        
        $constraints= array($this->getValidator($tags[$id][Tags::kTAG_GID]));
        
        $required= false;
        if($this->checkRequiredField){
            $required= in_array(':REQUIRED', $tags[$id][Tags::kTAG_TYPE]);
            if($required)
                $constraints[]= new NotBlank();
        }
            
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
            
        return $defaultOptions;
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
    
    public function clearTag($tag)
    {
        $id= $tag;
        if(strpos($tag,'_') !== false){
            $idArray= explode('_', $tag);
            $id= $idArray[count($idArray)-1];
        }
        
        return $id;
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