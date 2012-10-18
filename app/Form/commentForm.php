<?php

require_once __DIR__.'/../../lib/DBConnection/CommentDB.php';

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\User;
use Lib\DBConnection\CommentDB;

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));

$dbmanager= new CommentDB($app);

$profile= $app['session']->get('user')->getRoles();
$profile[0] == 'ROLE_ADMIN'?
  $result= true : $result= false; 
  
if ('POST' == $request->getMethod()) {
  $data = $_POST;
  
  if (!$data['inputEmail'] || !$data['inputComment']) {
    $app['session']->set('last_error', array('error' => 'Both data is required', 'status' => 'new'));
  }else{
    $app['session']->clear('last_error');
    
    $dbmanager->save($_POST);
    return $app['twig']
            ->render('dashboard.twig',
                      array('link_active' => 'dashboard',
                            'show_result' => $result,
                            'tankyou_message' => true));
  }
}

$comments= $dbmanager->getAll();

return $app['twig']
        ->render('dashboard.twig',
                  array('link_active' => 'dashboard',
                        'show_result' => $result,
                        'comments' => $comments,
                        'tankyou_message' => false
                        )
                );