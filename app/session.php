<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->register(new Silex\Provider\SessionServiceProvider());

$app->get('/', function () use ($app) {
  if (null !== $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('dashboard'));
  }
  return $app['twig']->render('homepage.twig');
})
->bind('homepage');

$app->match('/login', function(Request $request) use ($app) {
  if (null !== $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('dashboard'));
  }
  return require_once __DIR__.'/Form/loginForm.php';
})
->bind('login');

$app->get('/logout', function() use ($app) {
  $app['session']->clear();
  return $app->redirect($app['url_generator']->generate('homepage'));
})
->bind('logout');

$app->match('/registration', function (Request $request) use ($app) {
  if (null !== $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('dashboard'));
  }
  return require_once __DIR__.'/Form/registrationForm.php';
})
->bind('registration');