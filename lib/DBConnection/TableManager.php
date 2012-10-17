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
  
  public function getGENUS($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT GENUS FROM '.$table.' WHERE GENUS IS NOT NULL');
    
    return $fields;
  }
  
  public function getSPECIES($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT SPECIES FROM '.$table.' WHERE SPECIES IS NOT NULL');
    
    return $fields;
  }
  
  public function getNICODE($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT NICODE FROM '.$table.' WHERE NICODE IS NOT NULL');
    
    return $fields;
  }
  
  public function getNIENUMB($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT NIENUMB FROM '.$table.' WHERE NIENUMB IS NOT NULL');
    
    return $fields;
  }
  public function getINSTCODE($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT INSTCODE FROM '.$table.' WHERE INSTCODE IS NOT NULL');
    
    return $fields;
  }
  public function getSUBTAUTHOR($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT SUBTAUTHOR FROM '.$table.' WHERE SUBTAUTHOR IS NOT NULL');
    
    return $fields;
  }
  public function getTAXREF($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT TAXREF FROM '.$table.' WHERE TAXREF IS NOT NULL');
    
    return $fields;
  }
  public function getCROPNAME($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT CROPNAME FROM '.$table.' WHERE CROPNAME IS NOT NULL');
    
    return $fields;
  }
  public function getLRRECDATE($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRRECDATE FROM '.$table.' WHERE LRRECDATE IS NOT NULL');
    
    return $fields;
  }
  public function getLRNUMB($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRNUMB FROM '.$table.' WHERE LRNUMB IS NOT NULL');
    
    return $fields;
  }
  public function getLRNAME($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRNAME FROM '.$table.' WHERE LRNAME IS NOT NULL');
    
    return $fields;
  }
  public function getLRSLATDD($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRSLATDD FROM '.$table.' WHERE LRSLATDD IS NOT NULL');
    
    return $fields;
  }
  public function getFLONGDMS($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT FLONGDMS FROM '.$table.' WHERE FLONGDMS IS NOT NULL');
    
    return $fields;
  }
  public function getFLONGDD($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT FLONGDD FROM '.$table.' WHERE FLONGDD IS NOT NULL');
    
    return $fields;
  }
  public function getLRSEPSGCODE($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRSEPSGCODE FROM '.$table.' WHERE LRSEPSGCODE IS NOT NULL');
    
    return $fields;
  }
  public function getLRSGPS($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRSGPS FROM '.$table.' WHERE LRSGPS IS NOT NULL');
    
    return $fields;
  }
  public function getLRSRADIALED($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRSRADIALED FROM '.$table.' WHERE LRSRADIALED IS NOT NULL');
    
    return $fields;
  }
  public function getLRSELEVATION($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT LRSELEVATION FROM '.$table.' WHERE LRSELEVATION IS NOT NULL');
    
    return $fields;
  }
  public function getFARMERID($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT FARMERID FROM '.$table.' WHERE FARMERID IS NOT NULL');
    
    return $fields;
  }
  public function getFARMERYB($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT FARMERYB FROM '.$table.' WHERE FARMERYB IS NOT NULL');
    
    return $fields;
  }
  public function getFARMHT($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT FARMHT FROM '.$table.' WHERE FARMHT IS NOT NULL');
    
    return $fields;
  }
  public function getEXSECURE($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT EXSECURE FROM '.$table.' WHERE EXSECURE IS NOT NULL');
    
    return $fields;
  }
  public function getEXDUPL($table)
  {
    $fields = $this->app['db']->fetchAll('SELECT DISTINCT EXDUPL FROM '.$table.' WHERE EXDUPL IS NOT NULL');
    
    return $fields;
  }
}