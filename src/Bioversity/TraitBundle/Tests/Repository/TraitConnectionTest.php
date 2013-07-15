<?php

namespace Bioversity\TraitBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\TraitBundle\Repository\TraitConnection;

class TraitConnectionRepositoryTest extends WebTestCase
{
    private $word= 'Country of origin';
    private $gid= 'MCPD:INSTCODE';
    private $tag= array(546);
    private $structKey= 130;
    private $unit= ':DOMAIN-ACCESSION://USA016/1347800;';
    private $units= Array ( 'GENESYSTRAIT802' => Array( '130.928' => Array(), '928' => Array() ) ) ;
    private $page=1;
    private $nid= Array('type' => ':BINARY','data' => 'bd6b9490572349d3c16fbb04776389fb');
    
    protected function setUp()
    {
        $this->repo= new TraitConnection();
    }
    
    public function testGetTraits()
    {
        $response= $this->repo->getTraits($this->word);
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
    }
    
    public function testGetTrait()
    {
        $response= $this->repo->getTrait($this->gid);
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($response->getResponse()->getAllResponse()[0][1] == 'INSTCODE');
    }
    
    public function testGetTags()
    {
        $response= $this->repo->getTags($this->tag);
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($response->getResponse()->getIds() == array(546));
        $this->assertTrue(array_key_exists('GENESYS:TRAIT:558', $response->getResponse()->getTerm()));
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 12);
    }
    
    public function testGetTrials()
    {
        $response= $this->repo->getTrials($this->structKey, $this->unit, $this->page);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 2 );
        $this->assertTrue($response->getResponse()->getIds() == array(0,1));
        $this->assertTrue(array_key_exists('GR:TRIAL-SERIES', $response->getResponse()->getTerm()));
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 52);
        $this->assertTrue(count($response->getResponse()->getUnit()) == 2);
    }
    
    public function testGetUnit()
    {
        $response= $this->repo->getUnit($this->nid);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($response->getResponse()->getIds() == array(':DOMAIN-TRIAL://USA/1031;'));
        $this->assertTrue(array_key_exists(':AUTHORITY', $response->getResponse()->getTerm()));
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 17);
        $this->assertTrue(count($response->getResponse()->getUnit()) == 1);
    }
    
    public function testGetUnitByGID()
    {
        $response= $this->repo->getUnitByGID($this->unit);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($response->getResponse()->getIds() == array(':DOMAIN-ACCESSION://USA016/1347800;'));
        $this->assertTrue(array_key_exists(':AUTHORITY', $response->getResponse()->getTerm()));
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 42);
        $this->assertTrue(count($response->getResponse()->getUnit()) == 1);
    }
    
    public function testGetUnits()
    {        
        $response= $this->repo->getUnits($this->units);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 2881 );
        $this->assertTrue($response->getResponse()->getIds() == array(
                                                                    ':DOMAIN-ACCESSION://USA016/1552134;',
                                                                    ':DOMAIN-ACCESSION://USA016/1155828;',
                                                                    ':DOMAIN-ACCESSION://USA016/1394238;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421734;',
                                                                    ':DOMAIN-ACCESSION://USA016/1460132;',
                                                                    ':DOMAIN-ACCESSION://USA016/1445616;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458564;',
                                                                    ':DOMAIN-ACCESSION://USA016/1041491;',
                                                                    ':DOMAIN-ACCESSION://USA016/1422165;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458236;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370248;',
                                                                    ':DOMAIN-ACCESSION://USA016/1427814;',
                                                                    ':DOMAIN-ACCESSION://USA016/1455444;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421692;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458367;',
                                                                    ':DOMAIN-ACCESSION://USA016/1551547;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554194;',
                                                                    ':DOMAIN-ACCESSION://USA016/1445790;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370255;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554228;',
                                                                    ':DOMAIN-ACCESSION://USA016/1551583;',
                                                                    ':DOMAIN-ACCESSION://USA016/1153934;',
                                                                    ':DOMAIN-ACCESSION://USA016/1552190;',
                                                                    ':DOMAIN-ACCESSION://USA016/1427812;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458680;',
                                                                    ':DOMAIN-ACCESSION://USA016/1230499;',
                                                                    ':DOMAIN-ACCESSION://USA016/1550265;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458224;',
                                                                    ':DOMAIN-ACCESSION://USA016/1437663;',
                                                                    ':DOMAIN-ACCESSION://USA016/1462919;',
                                                                    ':DOMAIN-ACCESSION://USA016/1125504;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458061;',
                                                                    ':DOMAIN-ACCESSION://USA016/1428700;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458530;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370152;',
                                                                    ':DOMAIN-ACCESSION://USA016/1308355;',
                                                                    ':DOMAIN-ACCESSION://USA016/1422087;',
                                                                    ':DOMAIN-ACCESSION://USA016/1455395;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554237;',
                                                                    ':DOMAIN-ACCESSION://USA016/1230278;',
                                                                    ':DOMAIN-ACCESSION://USA016/1228832;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421684;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458604;',
                                                                    ':DOMAIN-ACCESSION://USA016/1007542;',
                                                                    ':DOMAIN-ACCESSION://USA016/1483811;',
                                                                    ':DOMAIN-ACCESSION://USA016/1227526;',
                                                                    ':DOMAIN-ACCESSION://USA016/1217030;',
                                                                    ':DOMAIN-ACCESSION://USA016/1442903;',
                                                                    ':DOMAIN-ACCESSION://USA016/1389937;',
                                                                    ':DOMAIN-ACCESSION://USA016/1428767;',));
        $this->assertTrue(count(array_keys($response->getResponse()->getTerm())) == 80);
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 52);
        $this->assertTrue(count($response->getResponse()->getUnit()) == 50);
        $this->assertTrue(array_keys($response->getResponse()->getUnit()) == array(
                                                                    ':DOMAIN-ACCESSION://USA016/1552134;',
                                                                    ':DOMAIN-ACCESSION://USA016/1155828;',
                                                                    ':DOMAIN-ACCESSION://USA016/1394238;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421734;',
                                                                    ':DOMAIN-ACCESSION://USA016/1460132;',
                                                                    ':DOMAIN-ACCESSION://USA016/1445616;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458564;',
                                                                    ':DOMAIN-ACCESSION://USA016/1041491;',
                                                                    ':DOMAIN-ACCESSION://USA016/1422165;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458236;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370248;',
                                                                    ':DOMAIN-ACCESSION://USA016/1427814;',
                                                                    ':DOMAIN-ACCESSION://USA016/1455444;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421692;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458367;',
                                                                    ':DOMAIN-ACCESSION://USA016/1551547;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554194;',
                                                                    ':DOMAIN-ACCESSION://USA016/1445790;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370255;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554228;',
                                                                    ':DOMAIN-ACCESSION://USA016/1551583;',
                                                                    ':DOMAIN-ACCESSION://USA016/1153934;',
                                                                    ':DOMAIN-ACCESSION://USA016/1552190;',
                                                                    ':DOMAIN-ACCESSION://USA016/1427812;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458680;',
                                                                    ':DOMAIN-ACCESSION://USA016/1230499;',
                                                                    ':DOMAIN-ACCESSION://USA016/1550265;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458224;',
                                                                    ':DOMAIN-ACCESSION://USA016/1437663;',
                                                                    ':DOMAIN-ACCESSION://USA016/1462919;',
                                                                    ':DOMAIN-ACCESSION://USA016/1125504;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458061;',
                                                                    ':DOMAIN-ACCESSION://USA016/1428700;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458530;',
                                                                    ':DOMAIN-ACCESSION://USA016/1370152;',
                                                                    ':DOMAIN-ACCESSION://USA016/1308355;',
                                                                    ':DOMAIN-ACCESSION://USA016/1422087;',
                                                                    ':DOMAIN-ACCESSION://USA016/1455395;',
                                                                    ':DOMAIN-ACCESSION://USA016/1554237;',
                                                                    ':DOMAIN-ACCESSION://USA016/1230278;',
                                                                    ':DOMAIN-ACCESSION://USA016/1228832;',
                                                                    ':DOMAIN-ACCESSION://USA016/1421684;',
                                                                    ':DOMAIN-ACCESSION://USA016/1458604;',
                                                                    ':DOMAIN-ACCESSION://USA016/1007542;',
                                                                    ':DOMAIN-ACCESSION://USA016/1483811;',
                                                                    ':DOMAIN-ACCESSION://USA016/1227526;',
                                                                    ':DOMAIN-ACCESSION://USA016/1217030;',
                                                                    ':DOMAIN-ACCESSION://USA016/1442903;',
                                                                    ':DOMAIN-ACCESSION://USA016/1389937;',
                                                                    ':DOMAIN-ACCESSION://USA016/1428767;',
                                                                        ));
    }
}