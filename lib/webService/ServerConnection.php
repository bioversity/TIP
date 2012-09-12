<?php

namespace Lib\WebService;

class ServerConnection
{
  static public function checkUserLogin($credential=null)
  {
    if($credential['username'] != 'admin')
      return false;
    else
      return array('username' => 'admin', 'password' => 'admin', 'roles' => 'ROLE_ADMIN');
  } 
  
  static public function registerUser($credential)
  {
    if(!$credential)
      return false;
    else    
      return array('username' => $credential['username'], 'password' => $credential['password'], 'roles' => 'ROLE_ADMIN');
  } 
  
  static public function editUserProfile($credential)
  {
    if(!$credential)
      return false;
    else    
      return array('username' => $credential['username'], 'password' => $credential['password'], 'roles' => 'ROLE_ADMIN');
  }
}