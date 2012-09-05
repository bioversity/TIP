<?php

namespace Lib\WebService;

class ServerConnection
{
  static public function checkUserLogin($credential=null)
  {
    return array('username' => 'admin', 'password' => 'foo', 'roles' => 'ROLE_ADMIN');
  }
}