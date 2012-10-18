<?php

namespace Lib\DBConnection;

require_once __DIR__.'/TableManager.php';

use Lib\DBConnection\TableManager;

class CommentDB extends TableManager
{
  var $app;
  
  public function __construct($application){
    parent::__construct($application);
    $this->app= $application;
  }
  
  public function getAll()
  {
    $fields = $this->app['db']->fetchAll('SELECT * FROM comment');
    
    return $fields;
  }
  
  public function save($data)
  {
    $fields = $this->app['db']
                ->query('INSERT INTO comment (email, comment) VALUES (\''.$data['inputEmail'].'\',\''.$data['inputComment'].'\')')->execute();    
    return $fields;
  }
}