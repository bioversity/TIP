<?php

require_once __DIR__.'/../../lib/DBConnection/LandraceDB.php';
require_once __DIR__.'/../../lib/DBConnection/CwrDB.php';
require_once __DIR__.'/../../lib/Helper/DataFormatter.php';

use Lib\DBConnection\LandraceDB;
use Lib\DBConnection\CwrDB;
use Lib\Helper\DataFormatter;

$landraceConnection= new LandraceDB($app);
$cwrConnection= new cwrDB($app);
//$dataFormatter= new DataFormatter();
//
//$tableInformation= $landraceConnection->getTableInfo('TAXA');
//
//$taxas= $landraceConnection->getAll();
//
//$datas= $dataFormatter->formatData($tableInformation, $taxas);

switch ($label_id){
  case 'TAXON_IDENTIFICATION':
    return $app['twig']->render('treat_taxon.twig',
                                array(
                                  'genus_lanrade' => $landraceConnection->getGENUS('landrace'),
                                  'species_lanrade' => $landraceConnection->getSPECIES('landrace'),
                                  'cropname_lanrade' => $landraceConnection->getCROPNAME('landrace'),
                                  'genus_cwr' => $cwrConnection->getGENUS('cropwildrelative'),
                                  'species_cwr' => $cwrConnection->getSPECIES('cropwildrelative'),
                                  'cropname_cwr' => $cwrConnection->getCROPNAME('cropwildrelative')
                                ));
  
  case 'INVENTORY_IDENTIFICATION':
    return $app['twig']->render('treat_inventory.twig',
                                array(
                                  'nicode_lanrade' => $landraceConnection->getNICODE('landrace'),
                                  'instcode_lanrade' => $landraceConnection->getINSTCODE('landrace'),
                                  'nicode_cwr' => $cwrConnection->getNICODE('cropwildrelative'),
                                  'instcode_cwr' => $cwrConnection->getINSTCODE('cropwildrelative')
                                ));
  
  case 'LANDRACE_POPULATION_IDENTIFICATION':
    return $app['twig']->render('treat_landrace.twig');
  
  case 'SITE_LOCATION_IDENTIFICATION':
    return $app['twig']->render('treat_site_location.twig',
                                array(
                                  'lrsgps_lanrade' => $landraceConnection->getLRSGPS('landrace'),
                                  'lrslatdd_lanrade' => $landraceConnection->getLRSLATDD('landrace'),
                                  'flongdd_lanrade' => $landraceConnection->getFLONGDD('landrace'),
                                  'lrsgps_cwr' => $cwrConnection->getLRSGPS('cropwildrelative'),
                                  'lrslatdd_cwr' => $cwrConnection->getLRSLATDD('cropwildrelative'),
                                  'flongdd_cwr' => $cwrConnection->getFLONGDD('cropwildrelative')
                                ));
}