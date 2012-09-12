<?php

require_once __DIR__.'/../../lib/webService/ServerConnection.php';

use Symfony\Component\Security\Core\User\User;
use Lib\WebService\ServerConnection;

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

if ('POST' == $request->getMethod()) {
  $data = $_POST;

  $connection= new ServerConnection();
  $user= $connection::editUserProfile($data);
  
  if (!$user) {
    $app['session']->set('last_error', array('error' => sprintf('Username "%s" does not exist.', $data['username'])));
  }else{
    $app['session']->clear('last_error');
    $app['session']->set('user', new User($user['username'], $user['password'], explode(',', $user['roles']), true, true, true, true));
  
    // redirect somewhere
    return $app->redirect($app['url_generator']->generate('dashboard'));
  }
}

return $app->redirect($app['url_generator']->generate('homepage'));