<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponsePagingRepositoryTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    private $objectClass;
    
    public function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
        $this->objectClass= $this->serverResponseClass->getPaging();
    }
    
    public function testClass()
    {
        $this->assertTrue(get_class($this->objectClass) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponsePagingManager' );
    }
    
    public function testClassHierarchy()
    {
        $pageStart = $this->objectClass->getPageStart();
        $pageLimit = $this->objectClass->getPageLimit();
        $pageCount = $this->objectClass->getPageCount();
        
        $this->assertTrue($pageStart ==  0);
        $this->assertTrue($pageLimit ==  50);
        $this->assertTrue($pageCount ==  10);
    }
}
