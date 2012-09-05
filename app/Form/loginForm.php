<?php

require_once __DIR__.'/../../lib/webService/ServerConnection.php';

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\User;
use Lib\WebService\ServerConnection;
use Silex\Provider\FormServiceProvider;

$app->register(new FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

$form= createLoginForm($app);

$app['security.last_error']= '';

if ('POST' == $request->getMethod()) {
  $form->bindRequest($request);

  if ($form->isValid()) {
      $data = $form->getData();

      $connection= new ServerConnection();
      $user= $connection::checkUserLogin();
      
      if (!$user) {
        $app['security.last_error']= sprintf('Username "%s" does not exist.', $data['username']);
      }else{
        $app['session']->set('user', new User($user['username'], $user['password'], explode(',', $user['roles']), true, true, true, true));
      
        // redirect somewhere
        return $app->redirect($app['url_generator']->generate('dashboard'));
      }
  }
}

return $app['twig']->render('login.twig', array(
    'form'  => $form->createView(),
    'error' => $app['security.last_error'],
    'last_username' => $app['session']->get('_security.last_username'),
  )
);

function createLoginForm(Silex\Application $app)
{
  return $app['form.factory']->createBuilder('form')
    ->add('username', 'text', array(
        'constraints' => array(new Assert\NotBlank(), new Assert\MinLength(5))
    ))
    ->add('password', 'password', array(
        'constraints' => array(new Assert\NotBlank(), new Assert\MinLength(5))
    ))
    ->getForm();
}