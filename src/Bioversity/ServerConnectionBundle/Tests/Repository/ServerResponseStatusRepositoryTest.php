<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponseStatusRepositoryTest extends WebTestCase
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
        $statusLevel   = $this->serverResponseClass->getStatus()->getStatusLevel();
        $statusCode    = $this->serverResponseClass->getStatus()->getStatusCode();
        $affectedCount = $this->serverResponseClass->getStatus()->getAffectedCount();
        
        $this->assertTrue($statusLevel   ==  0);
        $this->assertTrue($statusCode    ==  0);
        $this->assertTrue($affectedCount ==  2);
    }
}
