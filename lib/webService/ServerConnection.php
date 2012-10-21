<?php

namespace Lib\WebService;

class ServerConnection
{
  static public function checkUserLogin($credential=null)
  {
    if($credential['username'] == 'admin' || $credential['username'] == 'guest' )
        if($credential['username']== 'admin' && $credential['password']== 'nimda'){
          return array('username' => 'admin', 'password' => 'nimda', 'roles' => 'ROLE_ADMIN');
        }
        elseif($credential['username']== 'guest' && $credential['password']== 'guest'){
          return array('username' => 'guest', 'password' => 'guest', 'roles' => 'ROLE_USER');
        }else{
      return false;
    }
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