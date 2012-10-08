<?php

namespace Lib\DBConnection;

require_once __DIR__.'/TableManager.php';

use Lib\DBConnection\TableManager;

class LandraceDB extends TableManager
{
  var $app;
  
  public function __construct($application){
    parent::__construct($application);
    $this->app= $application;
  }
  
  public function getAll()
  {
    $taxas = $this->app['db']->query('SELECT * FROM TAXA');
    
    return $taxas;
  }
}