<?php

require_once __DIR__.'/../../lib/webService/ServerConnection.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\User;
use Lib\WebService\ServerConnection;

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

//$form= createLoginForm($app);

if ('POST' == $request->getMethod()) {
  //$form->bindRequest($request);

  //if ($form->isValid()) {
      $data = $_POST;

      $connection= new ServerConnection();
      $user= $connection::checkUserLogin($data);
      
      if (!$user) {
        $app['session']->set('last_error', array('error' => sprintf('Username "%s" does not exist.', $data['username'])));
      }else{
        $app['session']->clear('last_error');
        $app['session']->set('user', new User($user['username'], $user['password'], explode(',', $user['roles']), true, true, true, true));
      
        // redirect somewhere
        return $app->redirect($app['url_generator']->generate('dashboard'));
      }
  //}
}

return $app->redirect($app['url_generator']->generate('homepage'));

//return $app['twig']->render('login.twig', array(
//    'form'  => $form->createView(),
//    'error' => $app['security.last_error'],
//    'last_username' => $app['session']->get('_security.last_username'),
//  )
//);

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