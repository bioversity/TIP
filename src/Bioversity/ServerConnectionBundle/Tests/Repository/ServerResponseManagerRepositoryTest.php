<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponseManagerRepositoryTest extends WebTestCase
{
    private $response;
    private $mokedResponse;
    private $mokedResponseClass;
    
    protected function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->response= new ServerResponseManager($this->mokedResponse);
    }
    
    public function testClassLoader()
    {
        $class= $this->response;
        
        $this->assertTrue(get_class($class) ==  'Bioversity\ServerConnectionBundle\Repository\ServerResponseManager');
    }
    
    public function testGetResponse()
    {
        $response= $this->response->getResponse();
        $this->assertTrue(get_class($response) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseResponseManager');
    }
    
    public function testGetRequest()
    {
        $request= $this->response->getRequest();
        $this->assertTrue(get_class($request) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestManager');
    }
    
    public function testGetPaging()
    {
        $paging= $this->response->getPaging();
        $this->assertTrue(get_class($paging) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponsePagingManager');
    }
    
    public function testGetStatus()
    {
        $status= $this->response->getStatus();
        $this->assertTrue(get_class($status) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseStatusManager');
        
    }
}