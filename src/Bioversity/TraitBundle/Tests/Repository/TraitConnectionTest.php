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
    private $unitsummary= Array ( 'GRGENUS' => Array( '88' => 'Oryza' ) ) ;
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
        $this->assertTrue(count($response->getResponse()->getIds()) == 50);
        $this->assertTrue(count(array_keys($response->getResponse()->getTerm())) == 82);
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 52);
        $this->assertTrue(count($response->getResponse()->getUnit()) == 50);
    }
    
    public function testGetUnitSummary()
    {        
        $response= $this->repo->getUnitSummary($this->unitsummary);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue(count($response->getResponse()->getIds()) == 1);
        $this->assertTrue(count(array_keys($response->getResponse()->getTerm())) == 13);
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 12);
        $this->assertTrue($response->getResponse()->getUnit() == array());
        $this->assertTrue(get_class($response->getResponse()->getDistinct()) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseResponseDistinctManager');
        $this->assertTrue($response->getResponse()->getDistinct()->getTags() == array(6));
    }
    
    public function testGetUnitsFilterByDomain()
    {        
        $response= $this->repo->getUnitsFilterByDomain($this->unitsummary, ':DOMAIN-ACCESSION');
        
        $this->assertTrue($response == 'http://temp.wrapper.grinfo.net/TIP/Wrapper.test.php?:WS:OPERATION=WS:OP:GetAnnotated&:WS:FORMAT=:JSON&:WS:DATABASE=%22TEST-PGRSECURE%22&:WS:DATABASE-BIS=%22TEST-ONTOLOGY%22&:WS:CONTAINER=%22%3A_units%22&:WS:QUERY=%7B%22%24AND%22%3A%5B%7B%22%24OR%22%3A%5B%7B%22%24AND%22%3A%5B%7B%22_query-subject%22%3A%2240%22%2C%22_query-operator%22%3A%22%24EQ%22%2C%22_query-data-type%22%3A%22%3AINT%22%2C%22_query-data%22%3A88%7D%2C%7B%22%24OR%22%3A%5B%7B%22_query-subject%22%3A%2288%22%2C%22_query-operator%22%3A%22%24PX%22%2C%22_query-data-type%22%3A%22%3ASTRING%22%2C%22_query-data%22%3A%22Oryza%22%7D%5D%7D%5D%7D%5D%7D%2C%7B%22%24OR%22%3A%5B%7B%22%24AND%22%3A%5B%7B%22%24OR%22%3A%5B%7B%22_query-subject%22%3A%226%22%2C%22_query-operator%22%3A%22%24EQ%22%2C%22_query-data-type%22%3A%22%3ASTRING%22%2C%22_query-data%22%3A%22%3ADOMAIN-ACCESSION%22%7D%5D%7D%5D%7D%5D%7D%5D%7D&:WS:LOG-REQUEST=1&:WS:PAGE-START=0' );
    }
}