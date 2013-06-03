<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponseRequestRepositoryTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    
    public function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
    }
    
    public function testClassHierarchy()
    {
        $format = $this->serverResponseClass->getRequest()->getFormat();
        $operation = $this->serverResponseClass->getRequest()->getOperation();
        $database = $this->serverResponseClass->getRequest()->getDatabase();
        $container = $this->serverResponseClass->getRequest()->getContainer();
        $pageLimit = $this->serverResponseClass->getRequest()->getPageLimit();
        $query = $this->serverResponseClass->getRequest()->getQuery();
        $select = $this->serverResponseClass->getRequest()->getSelect();
        
        $this->assertTrue($format    == ':JSON');
        $this->assertTrue($operation == 'WS:OP:GetVertex');
        $this->assertTrue($database  == 'ONTOLOGY');
        $this->assertTrue($container == ':_nodes');
        $this->assertTrue($pageLimit == 50);
        $this->assertTrue($select    == array('2','19','20','21','9','10'));
        
        
        
        $this->assertTrue(get_class($query) == 'Bioversity\ServerConnectionBundle\Repository\ServerQueryManager' );
    }
}
