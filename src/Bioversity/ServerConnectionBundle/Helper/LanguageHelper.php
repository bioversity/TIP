<?php

namespace Bioversity\ServerConnectionBundle\Helper;

class LanguageHelper
{   
    public function getName()
    {
        return 'LanguageHelper';
    }
    
    public static function checkLanguage(array $nodeLabel)
    {
        return array_key_exists('en', $nodeLabel)? $nodeLabel['en'] : $nodeLabel[0];
    }
    
}