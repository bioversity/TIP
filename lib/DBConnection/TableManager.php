<?php

namespace Lib\DBConnection;

class TableManager
{
  private $app;
  
  public function __construct($application){
    $this->app= $application;
  }
  
  public function getTableInfo($table){
    $tableData=
      $this->app['db']
           ->query('
              SELECT *
              FROM `INFORMATION_SCHEMA`.`COLUMNS`
              WHERE `INFORMATION_SCHEMA`.`COLUMNS`.`TABLE_NAME` = \''.$table.'\'
              ORDER BY ORDINAL_POSITION
          ');
           
    return $tableData;
  }
}