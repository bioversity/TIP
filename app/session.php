<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\SessionServiceProvider());

if($error= $app['session']->get('last_error')){
  if($error['status'] == 'new' || $error['status'] == null){
    $error['status']= 'old';
    $app['session']->set('last_error', $error);
  }else{
    $app['session']->clear('last_error');
  }
}

$app->get('/', function () use ($app) {
  return $app['twig']->render('homepage.twig', array('link_active' => 'homepage'));
})
->bind('homepage');

$app->match('/login', function(Request $request) use ($app) {
  if (null !== $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('dashboard', array('link_active' => 'dashboard')));
  }
  return require_once __DIR__.'/Form/loginForm.php';
})
->bind('login');

$app->get('/logout', function() use ($app) {
  $app['session']->clear();
  return $app->redirect($app['url_generator']->generate('homepage', array('link_active' => 'homepage')));
})
->bind('logout');

$app->match('/registration', function (Request $request) use ($app) {
  if (null !== $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('dashboard', array('link_active' => 'dashboard')));
  }
  return require_once __DIR__.'/Form/registrationForm.php';
})
->bind('registration');