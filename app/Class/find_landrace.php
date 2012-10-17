<?php

require_once __DIR__.'/../../lib/DBConnection/LandraceDB.php';

use Lib\DBConnection\LandraceDB;
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());

if ('POST' == $request->getMethod()) {  
  $dbmanager= new LandraceDB($app);
  
  if($explode)
    return json_encode($dbmanager->findLandrace($_POST));
  else{
    if($_POST['record_id'])
      return json_encode($dbmanager->getLandrace($_POST['record_id']));
    else
      return $dbmanager->countLandrace($_POST);
  }
}