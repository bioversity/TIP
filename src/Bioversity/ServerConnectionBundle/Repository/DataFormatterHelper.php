<?php

namespace Bioversity\ServerConnectionBundle\Repository;

class DataFormatterHelper
{
    public static function clearSubmittedData($formData)
    {
        foreach($formData as $data=>$value){
            if(!$value){
                unset($formData[$data]);
            }else if($data== Tags::kTAG_LABEL || $data== Tags::kTAG_DEFINITION){
                $formData[$data]= array('en' => $value);
            }else if($data == Tags::kTAG_SYNONYMS || $data == Tags::kTAG_CATEGORY){
                $formData[$data]= self::convertData(explode(',', $value));
            }
        }
        
        return $formData;
    }
    
    public static function formatSynonyms($synonyms)
    {
        if($synonyms)
            return explode(',', $synonyms);
        else
            return NULL;
    }
    
    public static function formatCategory($category)
    {
        if($category)
            return explode(',', $category);
        else
            return NULL;
    }
}