<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponseResponseDistinctTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    private $objectClass;
    
    public function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
        $this->objectClass= $this->serverResponseClass->getResponse()->getDistinct();
    }
    
    public function testClass()
    {
        $this->assertTrue(get_class($this->objectClass) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseResponseDistinctManager' );
    }
    
    public function testClassHierarchy()
    {
        $tags = $this->objectClass->getTags();
        $values = $this->objectClass->getTagsValues($tags[0]);
        
        $this->assertTrue(count($values) ==  5);
        $this->assertTrue($tags ==  array(218));
    }
}
