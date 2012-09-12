<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
  'translator.messages' => array(),
));

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
