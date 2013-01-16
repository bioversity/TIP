<?php

namespace Bioversity\SecurityBundle\Repository;

class NotificationManager
{    
    static public function getNotice($error_code)
    {
        $noticeList= self::noticeList();
        return $noticeList[$error_code];
    }
    
    static public function noticeList()
    {
        return array(
            '0'         => 'User is successiful created',
            '11000'     => 'The username is already used by another user',
            'not_found' => 'Element not found'
        );
    }
}