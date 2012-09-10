<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;

// Sielx new instance--------------------------------------------------
$app = new Silex\Application();
// Register basic servive----------------------------------------------
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../src/Resource/view'
));

$app->before(function () use ($app) {
    $app['twig']->addGlobal('frontend_layout', $app['twig']->loadTemplate('frontend_base.twig'));
});