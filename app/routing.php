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
  
  $app->match('/block-note', function (Request $request) use ($app) {
    return $app['twig']->render('block_note.twig', array('link_active' => 'about'));
  })
  ->bind('block_note');
  
  $app->match('/database', function (Request $request) use ($app) {
    return $app['twig']->render('database.twig', array('link_active' => 'database'));
  })
  ->bind('page_database');

/*--------------------------------------------------
  LANDRACE PATH
----------------------------------------------------*/
  $app->match('/browse-landrace', function (Request $request) use ($app) {
    $landraceField= array(
      array('name'=>'TAXON IDENTIFICATION', 'status'=>'enabled'),
      array('name'=>'INVENTORY IDENTIFICATION', 'status'=>'enabled'),
      array('name'=>'SITE LOCATION IDENTIFICATION', 'status'=>'enabled'),
      array('name'=>'INFORMATION BY TRAIT', 'status'=>'enabled')
    );
    
    return $app['twig']->render('browse_landrace.twig',
      array(
        'link_active' => 'browse_landrace',
        'landrace_field' => $landraceField
      ));
  })
  ->bind('browse_landrace');
  
  $app->match('/search-landrace', function (Request $request) use ($app) {
    $explode= false;
    return require_once __DIR__.'/Class/find_landrace.php';
  })
  ->bind('search_landrace');

  $app->match('/get-landrace', function (Request $request) use ($app) {
    $explode= true;
    return require_once __DIR__.'/Class/find_landrace.php';
  })
  ->bind('get_landrace');
  
  $app->match('/get-landrace-record', function (Request $request) use ($app) {
    $explode= false;
    return require_once __DIR__.'/Class/find_landrace.php';
  })
  ->bind('get_landrace_record');
  
  $app->match('/get-landrace-detail/{label_id}', function ($label_id) use ($app) {
    return require_once __DIR__.'/Class/landrace.php';
  })
  ->bind('get_landrace_detail');

/*--------------------------------------------------
  CROP-CAT-TRAIT PATH
----------------------------------------------------*/
  $app->match('/get-trait-cat/{crop_id}', function (Request $request) use ($app) {
    return require_once __DIR__.'/Class/find_trait.php';
  })
  ->bind('get_trait_cat');

  $app->match('/browse-trait', function (Request $request) use ($app) {
    return require_once __DIR__.'/Class/trait.php';
  })
  ->bind('browse_trait');

  $app->match('/search-trait', function (Request $request) use ($app) {
    return require_once __DIR__.'/Class/find_trait.php';
  })
  ->bind('search_trait');
  
  $app->match('/update-trait-select', function (Request $request) use ($app) {
    return require_once __DIR__.'/Class/trait.php';
  })
  ->bind('update_trait_select');

/*--------------------------------------------------
  CWR PATH
----------------------------------------------------*/

  $app->match('/browse-cwr', function (Request $request) use ($app) {
    return $app['twig']->render('browse_cwr.twig', array('link_active' => 'browse_cwr'));
  })
  ->bind('browse_cwr');
  
  $app->match('/search-cwr', function (Request $request) use ($app) {
    return require_once __DIR__.'/Class/find_cwr.php';
  })
  ->bind('search_cwr');

  $app->match('/get-cwr', function (Request $request) use ($app) {
    $explode= true;
    return require_once __DIR__.'/Class/find_cwr.php';
  })
  ->bind('get_cwr');
  
  $app->match('/get-cwr-record', function (Request $request) use ($app) {
    $explode= false;
    return require_once __DIR__.'/Class/find_cwr.php';
  })
  ->bind('cwr');
  
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
    return require_once __DIR__.'/Form/commentForm.php';
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