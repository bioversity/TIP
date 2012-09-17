<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
  'translator.messages' => array(),
));


/*--------------------------------------------------
  UNLOGGED PATH
----------------------------------------------------*/
$app->match('/contact', function (Request $request) use ($app) {
  return $app['twig']->render('contact.twig', array('link_active' => 'contact'));
})
->bind('contact');

$app->match('/about', function (Request $request) use ($app) {
  return $app['twig']->render('about.twig', array('link_active' => 'about'));
})
->bind('about');

$app->match('/database', function (Request $request) use ($app) {
  return $app['twig']->render('database.twig', array('link_active' => 'database'));
})
->bind('page_database');

$app->match('/browse-landrace', function (Request $request) use ($app) {
  return $app['twig']->render('browse_landrace.twig', array('link_active' => 'browse_landrace'));
})
->bind('browse_landrace');

$app->match('/browse-cwr', function (Request $request) use ($app) {
  return $app['twig']->render('browse_cwr.twig', array('link_active' => 'browse_cwr'));
})
->bind('browse_cwr');

$app->match('/browse-trait', function (Request $request) use ($app) {
  return $app['twig']->render('browse_trait.twig', array('link_active' => 'browse_trait'));
})
->bind('browse_trait');


/*--------------------------------------------------
  LOGGED PATH
----------------------------------------------------*/
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


/*--------------------------------------------------
  DATASET ROUTE
----------------------------------------------------*/
$app->match('/datasets', function (Request $request) use ($app) {
  return $app['twig']->render('datasets.twig', array('link_active' => 'datasets'));
})
->bind('datasets');

$app->match('/data-search', function (Request $request) use ($app) {
  return $app['twig']->render('data_search.twig', array('link_active' => 'data_search'));
})
->bind('data_search');

$app->match('/download-data', function (Request $request) use ($app) {
  return $app['twig']->render('download_data.twig', array('link_active' => 'download_data'));
})
->bind('download_data');

$app->match('/request-data', function (Request $request) use ($app) {
  return $app['twig']->render('request_data.twig', array('link_active' => 'request_data'));
})
->bind('request_data');

$app->match('/contribute-data', function (Request $request) use ($app) {
  return $app['twig']->render('contribute_data.twig', array('link_active' => 'contribute_data'));
})
->bind('contribute_data');