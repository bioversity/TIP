<?php

namespace Bioversity\ServerConnectionBundle\Form;

use Bioversity\ServerConnectionBundle\Helper\LanguageHelper;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Nodes;

class BioversityDinamicFormType extends BioversityBaseType
{
    private $formFields= array();
    
    public function getName()
    {
        return '';
    }
    
    public function __construct($formFields)
    {
        $this->setInternationlization($formFields);
	$this->setCheckRequiredField(true);
    }
    
    public function getDefaultOptions(array $options)
    {
        $options = parent::getDefaultOptions($options);
        $options['csrf_protection'] = false;

        return $options;
    }
    
    /**
     *
     * This method is hight related to the logic behind the trait form
     * The logic used to create the field name is the same
     * The view use more parts of the trait template, same javascript and same css
     * 
     **/
    public static function createFieldSet($formFields)
    {
        $formGroup= array();
        $tagEntity= new Tags();
        $nodeEntity= new Nodes();

        foreach($formFields as $key=>$value){
            $formGroupLabel= LanguageHelper::checkLanguage($nodeEntity->getNodeByNID($key)->getResponse()->getNode()[$key][Tags::kTAG_LABEL]);
	        foreach($value as $k=>$v){
	            $tags= $tagEntity->getTags($v)->getResponse()->getTag();
                foreach($v as $ktag=>$vtag){
                    $origin= $tags[$vtag][Tags::kTAG_PATH][0];
                    if(array_key_exists(Tags::kTAG_OFFSETS, $tags[$vtag]))
                        $synonyms= self::getTagsString($vtag, $tags[$vtag][Tags::kTAG_OFFSETS]);
                        
                    $groupLabel= LanguageHelper::checkLanguage($nodeEntity->getNodeByNID($k)->getResponse()->getNode()[$k][Tags::kTAG_LABEL]);
	                // MILKO - Added replacement for other characters.
	                //$formGroup[$formGroupLabel][$groupLabel][]= str_replace(':','',$origin).'_'.$synonyms.$vtag;
	                $formGroup[$formGroupLabel][$groupLabel][]= str_replace(array(':','/','-','.'),'',$origin).'_'.$synonyms.$vtag;
                }
            }
        }
        
        return $formGroup;
    }
    
    public static function getTagsString($id, $tags= null)
    {
        $string= '';
        foreach($tags as $tag)
        {
            if($tag != $id)
                $string .= str_replace('.',':',$tag).'_';
        }
        
        return $string;
    }
    
}