<?php

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array (
      'driver'    => 'pdo_mysql',
      'host'      => 'localhost',
      'dbname'    => 'bioversity',
      'user'      => 'root',
      'password'  => 'root'
    ),
));