<?php

require_once __DIR__.'/../../lib/DBConnection/CwrDB.php';

use Lib\DBConnection\CwrDB;
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());

if ('POST' == $request->getMethod()) {  
  $dbmanager= new CwrDB($app);
  
  if($explode)
    return json_encode($dbmanager->findCwr($_POST));
  else{
    if($_POST['record_id'])
      return json_encode($dbmanager->getCwr($_POST['record_id']));
    else
      return $dbmanager->countCwr($_POST);
  }
}