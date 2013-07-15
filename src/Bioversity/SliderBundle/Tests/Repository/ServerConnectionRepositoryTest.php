<?php

namespace Bioversity\OntologyBundleBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\SliderBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class ServerConnectionRepositoryTest extends WebTestCase
{
    private $modelClass;
    private $formdataGID= array('2' => 'GENESYS:SCALE:525');
    private $formdataLABEL= array('19' => array('en' => ' Plant width in centimeters'));
    
    public function setUp()
    {
        parent::setUp();
        $this->modelClass= new ServerConnection();
    }
    
    public function testGetNodes()
    {
        $result= $this->modelClass->getNodes($this->formdataGID);
            
        $this->assertTrue($result->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($result->getResponse()->getAllResponse() == array(array('_id' => '19170',
                                                            '1'   => '525',
                                                            '2'   => 'GENESYS:SCALE:525',
                                                            '19'  => Array('en' => 'Plant width in centimeters'),                                    
                                                            '5'   => Array('0' => 'WIDTH'),                                    
                                                            '9'   => Array('0' => ':KIND-SCALE'),
                                                            '10'  => Array('0' => ':FLOAT'),
                                                            '131' => '525',
                                                            '29'  => Array(
                                                                    'type' => ':BINARY',
                                                                    'data' => 'ec7055e143260889a4d09aa2312de77d'
                                                                    ),
                                                            '11'  => 'COntologyMasterVertex'
                                                          )));
      
    }
    
    public function testGetRootNodes()
    {
        $result= $this->modelClass->getRootNodes();

        $this->assertTrue($result->getStatus()->getAffectedCount() == 10 );
        $this->assertTrue($result->getRequest()->getSelect() == array(2,19,20,21,9,10));
        $this->assertTrue($result->getPaging()->getPageLimit() == 50);
        $this->assertTrue($result->getResponse()->getIds() == array(1,271,17268,17298,17356,17357,17541,17755,17851,17934));
        $this->assertTrue(count($result->getResponse()->getTerm()) == 18);
        $this->assertTrue($result->getResponse()->getEdge() == array());
        $this->assertTrue(count($result->getResponse()->getNode()) == 10);
        $this->assertTrue(count($result->getResponse()->getTag()) == 5);
    }
    
    public function testGetNodeDetails()
    {
        $result= $this->modelClass->getNodeDetails(525);

        $this->assertTrue($result->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($result->getPaging()->getPageLimit() == 50);
        $this->assertTrue($result->getResponse()->getIds() == array(525));
        $this->assertTrue(count($result->getResponse()->getTerm()) == 21);
        $this->assertTrue($result->getResponse()->getEdge() == array());
        $this->assertTrue(count($result->getResponse()->getNode()) == 1);
        $this->assertTrue(count($result->getResponse()->getTag()) == 16);
    }
      
    public function testGetNodeRelationIN()
    {
        $result= $this->modelClass->getNodeRelationIN(17453); //GR:MORPHOLOGY

        $this->assertTrue($result->getStatus()->getAffectedCount() == 379 );
        $this->assertTrue($result->getPaging()->getPageLimit() == 25);
        $this->assertTrue(count($result->getResponse()->getIds()) == 25);
        $this->assertTrue(count($result->getResponse()->getTerm()) == 44);
        $this->assertTrue(count($result->getResponse()->getEdge()) == 25);
        $this->assertTrue(count($result->getResponse()->getNode()) == 26);
        $this->assertTrue(count($result->getResponse()->getTag()) == 17);
    }
    
    public function testGetNodeRelationOUT()
    {
        $result= $this->modelClass->getNodeRelationOUT(17453); //GR:MORPHOLOGY

        $this->assertTrue($result->getStatus()->getAffectedCount() == 2 );
        $this->assertTrue($result->getPaging()->getPageLimit() == 25);
        $this->assertTrue(count($result->getResponse()->getIds()) == 2);
        $this->assertTrue(count($result->getResponse()->getTerm()) == 22);
        $this->assertTrue(count($result->getResponse()->getEdge()) == 2);
        $this->assertTrue(count($result->getResponse()->getNode()) == 3);
        $this->assertTrue(count($result->getResponse()->getTag()) == 17);
    }
    
    public function testSearchNodeRelationIN()
    {
        $result= $this->modelClass->searchNodeRelationIN(17453, 'plant'); //PLANT
        
        $this->assertTrue($result->getStatus()->getAffectedCount() == 10 );
        $this->assertTrue($result->getPaging()->getPageLimit() == 25);
        $this->assertTrue($result->getResponse()->getIds() == array(18339,18462,18474,18476,18479,18484,18488,18491,18520,18619));
        $this->assertTrue(count($result->getResponse()->getTerm()) == 29);
        $this->assertTrue(count($result->getResponse()->getEdge()) == 10);
        $this->assertTrue(count($result->getResponse()->getNode()) == 11);
        $this->assertTrue(count($result->getResponse()->getTag()) == 17);
    }
    
    public function testSearchNodeRelationOUT()
    {
        $result= $this->modelClass->searchNodeRelationOUT(17453, 'g');
        
        $this->assertTrue($result->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($result->getPaging()->getPageLimit() == 25);
        $this->assertTrue($result->getResponse()->getIds() == array(17361));
        $this->assertTrue(count($result->getResponse()->getTerm()) == 20);
        $this->assertTrue(count($result->getResponse()->getEdge()) == 1);
        $this->assertTrue(count($result->getResponse()->getNode()) == 2);
        $this->assertTrue(count($result->getResponse()->getTag()) == 17);
    }
}