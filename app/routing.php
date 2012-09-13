<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
  'translator.messages' => array(),
));


//UNLOGGED PATH
$app->match('/contact', function (Request $request) use ($app) {
  return $app['twig']->render('contact.twig');
})
->bind('contact');

$app->match('/about', function (Request $request) use ($app) {
  return $app['twig']->render('about.twig');
})
->bind('about');

$app->match('/database', function (Request $request) use ($app) {
  return $app['twig']->render('database.twig');
})
->bind('page_database');

//LOGGED PATH
$app->match('/admin/add-tag', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return require_once __DIR__.'/Form/tagForm.php';
})
->bind('add_tag');

$app->match('/admin/dashboard', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return require_once __DIR__.'/dashboard.php';
})
->bind('dashboard');

$app->match('/admin/edit-profile', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return require_once __DIR__.'/Form/editProfileForm.php';
})
->bind('edit_profile');

$app->match('/admin/browse-landrace', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return $app['twig']->render('browse_landrace.twig');
})
->bind('browse_landrace');

$app->match('/admin/browse-cwr', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return $app['twig']->render('browse_cwr.twig');
})
->bind('browse_cwr');

$app->match('/admin/browse-trait', function (Request $request) use ($app) {
  if (null === $user = $app['session']->get('user')) {
    return $app->redirect($app['url_generator']->generate('login'));
  }
  return $app['twig']->render('browse_trait.twig');
})
->bind('browse_trait');
