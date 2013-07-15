<?php

namespace Bioversity\OntologyBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\OntologyBundle\Repository\ServerConnection;

class ServerConnectionTest extends WebTestCase
{
    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
    }
  
    public function testSaveNew()
    {
    }
    
    public function testSaveRelation()
    {
    }
    
}
