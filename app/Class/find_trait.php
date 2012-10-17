<?php

require_once __DIR__.'/../../lib/DBConnection/LandraceDB.php';

use Lib\DBConnection\LandraceDB;
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());

if ('POST' == $request->getMethod()) {
  $data = $_POST;
  
  return rand(1, 10);
}