<?php

namespace App;

use \Silex\Application;

class SecurityFirewall
{
  private $application;
  
  public function __construct(\Silex\Application $app)
  {
    $this->application= $app;
  }
  
  public function checkIfUserIsLoggedIn()
  {
    if(!array_key_exists('session', $this->application)){
      return $this->application->redirect($this->application['url_generator']->generate('login'));
    }else{
      if (null === $user = $this->application['session']->get('user')) {
        return $this->application->redirect($this->application['url_generator']->generate('login'));
      }
    }
  } 
}