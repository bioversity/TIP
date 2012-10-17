<?php

require_once __DIR__.'/../../lib/DBConnection/LandraceDB.php';

use Lib\DBConnection\LandraceDB;
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());

if ('POST' == $request->getMethod()) {
  $data = $_POST;
  return $data;
  if($type_name == 'landrace')
    return $app['twig']->render('landrace_result.twig', array('data' => $data));
}