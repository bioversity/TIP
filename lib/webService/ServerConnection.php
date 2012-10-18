<?php

namespace Lib\WebService;

class ServerConnection
{
  static public function checkUserLogin($credential=null)
  {
    if($credential['username'] == 'admin' || $credential['username'] == 'guest' )
      if($credential['username'] == $credential['password']){
        if($credential['username']== 'admin'){
          return array('username' => 'admin', 'password' => 'admin', 'roles' => 'ROLE_ADMIN');
        }
        else{
          return array('username' => 'guest', 'password' => 'guest', 'roles' => 'ROLE_USER');
        }
      }else{
        return false;
      }
    else{
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