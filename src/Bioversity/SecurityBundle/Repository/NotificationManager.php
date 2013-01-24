<?php

namespace Bioversity\SecurityBundle\Repository;

class NotificationManager
{    
    static public function getNotice($error_code, $field= NULL)
    {
        $noticeList= self::noticeList($field);
        return $noticeList[$error_code];
    }
    
    static public function noticeList($field= NULL)
    {
        return array(
            '0'                         => 'User is successiful created',
            '11000'                     => 'The username is already used by another user',
            'not_found'                 => 'Element not found',
            'element_exist'             => sprintf('The element %s already exist', $field),
            'combination_element_exist' => sprintf('The elements combination %s already exist', $field)
        );
    }
}