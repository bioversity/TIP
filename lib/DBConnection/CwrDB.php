<?php

namespace Lib\DBConnection;

require_once __DIR__.'/TableManager.php';

use Lib\DBConnection\TableManager;

class CwrDB extends TableManager
{
  var $app;
  
  public function __construct($application){
    parent::__construct($application);
    $this->app= $application;
  }
  
  public function getAllLandrace()
  {
    $fields = $this->app['db']->fetchColumn('SELECT * FROM landrace');
    
    return $fields;
  }
  
  public function countCwr($data)
  {
    $sql= 'SELECT count(*) FROM cropwildrelative WHERE 1=1 ';
    
    if($data['NICODE'])
      $sql .='AND NICODE=\''.$data['NICODE'].'\'';
      
    if($data['NIENUMB'])
      $sql .='AND NIENUMB=\''.$data['NIENUMB'].'\'';
      
    if($data['INSTCODE'])
      $sql .='AND INSTCODE=\''.$data['INSTCODE'].'\'';
      
    if($data['GENUS'])
      $sql .='AND GENUS=\''.$data['GENUS'].'\'';
      
    if($data['SPECIES'])
      $sql .='AND SPECIES=\''.$data['SPECIES'].'\'';
      
    if($data['SUBTAUTHOR'])
      $sql .='AND SUBTAUTHOR=\''.$data['SUBTAUTHOR'].'\'';
      
    if($data['TAXREF'])
      $sql .='AND TAXREF=\''.$data['TAXREF'].'\'';
      
    if($data['CROPNAME'])
      $sql .='AND CROPNAME=\''.$data['CROPNAME'].'\'';
      
    if($data['LRRECDATE'])
      $sql .='AND LRRECDATE=\''.$data['LRRECDATE'].'\'';
      
    if($data['LRNUMB'])
      $sql .='AND LRNUMB=\''.$data['LRNUMB'].'\'';
      
    if($data['LRNAME'])
      $sql .='AND LRNAME=\''.$data['LRNAME'].'\'';
      
    if($data['LRSLATDD'])
      $sql .='AND LRSLATDD=\''.$data['LRSLATDD'].'\'';
      
    if($data['FLONGDMS'])
      $sql .='AND FLONGDMS=\''.$data['FLONGDMS'].'\'';
      
    if($data['FLONGDD'])
      $sql .='AND FLONGDD=\''.$data['FLONGDD'].'\'';
      
    if($data['LRSEPSGCODE'])
      $sql .='AND LRSEPSGCODE=\''.$data['LRSEPSGCODE'].'\'';
      
    if($data['LRSGPS'])
      $sql .='AND LRSGPS=\''.$data['LRSGPS'].'\'';
      
    if($data['LRSRADIALED'])
      $sql .='AND LRSRADIALED=\''.$data['LRSRADIALED'].'\'';
      
    if($data['LRSELEVATION'])
      $sql .='AND LRSELEVATION=\''.$data['LRSELEVATION'].'\'';
      
    if($data['FARMERID'])
      $sql .='AND FARMERID=\''.$data['FARMERID'].'\'';
      
    if($data['FARMERYB'])
      $sql .='AND FARMERYB=\''.$data['FARMERYB'].'\'';
      
    if($data['FARMHT'])
      $sql .='AND FARMHT=\''.$data['FARMHT'].'\'';
      
    if($data['EXSECURE'])
      $sql .='AND EXSECURE=\''.$data['EXSECURE'].'\'';
      
    if($data['EXDUPL'])
      $sql .='AND EXDUPL=\''.$data['EXDUPL'].'\'';
      
    $count = $this->app['db']->fetchColumn($sql);
    
    return $count;
  }
  
  public function findCwr($data= null)
  {
    $sql= 'SELECT * FROM cropwildrelative WHERE 1=1 ';
    
    if($data['NICODE'])
      $sql .='AND NICODE=\''.$data['NICODE'].'\'';
      
    if($data['NIENUMB'])
      $sql .='AND NIENUMB=\''.$data['NIENUMB'].'\'';
      
    if($data['INSTCODE'])
      $sql .='AND INSTCODE=\''.$data['INSTCODE'].'\'';
      
    if($data['GENUS'])
      $sql .='AND GENUS=\''.$data['GENUS'].'\'';
      
    if($data['SPECIES'])
      $sql .='AND SPECIES=\''.$data['SPECIES'].'\'';
      
    if($data['SUBTAUTHOR'])
      $sql .='AND SUBTAUTHOR=\''.$data['SUBTAUTHOR'].'\'';
      
    if($data['TAXREF'])
      $sql .='AND TAXREF=\''.$data['TAXREF'].'\'';
      
    if($data['CROPNAME'])
      $sql .='AND CROPNAME=\''.$data['CROPNAME'].'\'';
      
    if($data['LRRECDATE'])
      $sql .='AND LRRECDATE=\''.$data['LRRECDATE'].'\'';
      
    if($data['LRNUMB'])
      $sql .='AND LRNUMB=\''.$data['LRNUMB'].'\'';
      
    if($data['LRNAME'])
      $sql .='AND LRNAME=\''.$data['LRNAME'].'\'';
      
    if($data['LRSLATDD'])
      $sql .='AND LRSLATDD=\''.$data['LRSLATDD'].'\'';
      
    if($data['FLONGDMS'])
      $sql .='AND FLONGDMS=\''.$data['FLONGDMS'].'\'';
      
    if($data['FLONGDD'])
      $sql .='AND FLONGDD=\''.$data['FLONGDD'].'\'';
      
    if($data['LRSEPSGCODE'])
      $sql .='AND LRSEPSGCODE=\''.$data['LRSEPSGCODE'].'\'';
      
    if($data['LRSGPS'])
      $sql .='AND LRSGPS=\''.$data['LRSGPS'].'\'';
      
    if($data['LRSRADIALED'])
      $sql .='AND LRSRADIALED=\''.$data['LRSRADIALED'].'\'';
      
    if($data['LRSELEVATION'])
      $sql .='AND LRSELEVATION=\''.$data['LRSELEVATION'].'\'';
      
    if($data['FARMERID'])
      $sql .='AND FARMERID=\''.$data['FARMERID'].'\'';
      
    if($data['FARMERYB'])
      $sql .='AND FARMERYB=\''.$data['FARMERYB'].'\'';
      
    if($data['FARMHT'])
      $sql .='AND FARMHT=\''.$data['FARMHT'].'\'';
      
    if($data['EXSECURE'])
      $sql .='AND EXSECURE=\''.$data['EXSECURE'].'\'';
      
    if($data['EXDUPL'])
      $sql .='AND EXDUPL=\''.$data['EXDUPL'].'\'';
    
    $query = $this->app['db']->fetchAll($sql);
    
    return $query;
  }
  
  public function getCwr($id)
  {
    $sql = "SELECT * FROM cropwildrelative WHERE id = ".$id;
    $post = $this->app['db']->fetchAssoc($sql);
    
    return $post;
  }
}