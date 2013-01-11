<?php

namespace Bioversity\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));

        $crawler = $client->request('GET', '/manage-user');

        //$this->assertTrue($crawler->filter('html:contains("Hello Fabien")')->count() > 0);
    }
}
