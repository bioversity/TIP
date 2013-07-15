<?php

namespace Bioversity\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\SecurityBundle\Repository\NotificationManager;

class NotificationManagerTest extends WebTestCase
{
    private $client;
    private $repo;
    
    public function setUp()
    {
        $this->repo= new NotificationManager();
    }
    
    public function testGetNotice()
    {
        $response= $this->repo->getNotice('0');
        $this->assertTrue($response == 'Element is successiful created');
        
        $response= $this->repo->getNotice('11000');
        $this->assertTrue($response == 'The username is already used by another user');
        
        $response= $this->repo->getNotice('not_found');
        $this->assertTrue($response == 'Element not found');
        
        $response= $this->repo->getNotice('element_exist', 'name');
        $this->assertTrue($response == 'The element name already exist');
        
        $response= $this->repo->getNotice('combination_element_exist', 'name');
        $this->assertTrue($response == 'The elements combination name already exist');
        
        $response= $this->repo->getNotice('default_value');
        $this->assertTrue($response == 'This is the defoult and uneditadle value');        
    }
}
