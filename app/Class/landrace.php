<?php

require_once __DIR__.'/../../lib/DBConnection/LandraceDB.php';
require_once __DIR__.'/../../lib/Helper/DataFormatter.php';

use Lib\DBConnection\LandraceDB;
use Lib\Helper\DataFormatter;

//$landraceConnection= new LandraceDB($app);
//$dataFormatter= new DataFormatter();
//
//$tableInformation= $landraceConnection->getTableInfo('TAXA');
//
//$taxas= $landraceConnection->getAll();
//
//$datas= $dataFormatter->formatData($tableInformation, $taxas);

switch ($label_id){
  case 'TAXON_IDENTIFICATION':
    return $app['twig']->render('treat_taxon.twig');
  case 'INVENTORY_IDENTIFICATION':
    return $app['twig']->render('treat_inventory.twig');
  case 'LANDRACE_POPULATION_IDENTIFICATION':
    return $app['twig']->render('treat_landrace.twig');
  case 'SITE_LOCATION_IDENTIFICATION':
    return $app['twig']->render('treat_site_location.twig');
}