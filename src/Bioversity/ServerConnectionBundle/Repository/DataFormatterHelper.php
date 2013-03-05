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
            }
        }
        
        return $formData;
    }
}