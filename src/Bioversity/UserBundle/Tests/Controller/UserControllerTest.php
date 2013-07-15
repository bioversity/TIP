<?php

namespace Bioversity\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\UserBundle\Tests\BaseTest;

class DefaultControllerTest extends WebTestCase
{
    private $client;
    private $userKey;
    private $userId;
    
    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
        $this->userKey= str_replace(':','_',date('Y-m-d-h:i'));
    }
    
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/admin/manage-user');

        $this->assertTrue($crawler->filter('.user_row')->count() > 0);
    }
    
    public function testNewUserAction()
    {
        $crawler = $this->client->request('GET', '/admin/manage-user/new-user');
        
        $form = $crawler->selectButton('Save')->form();
     
        $crawler = $this->client->submit($form, array(
            'BioversityUser[45]'  => 'utente prova-'. $this->userKey,
            'BioversityUser[46]'  => 'utente_prova'. $this->userKey,
            'BioversityUser[47]'  => 'utente_prova',
            'BioversityUser[48]'  => 'utente@prova.com',
            'BioversityUser[49]'  => array('ROLE_ADMIN'),
            'BioversityUser[53]'  => 'institute code',
            'BioversityUser[54]'  => 'institute name',
            'BioversityUser[55]'  => 'institute address',
            'BioversityUser[56]'  => '',
        ));
    }
    
    public function testEditUserAction()
    {
        $crawler = $this->client->request('GET', '/admin/manage-user/edit/utente_prova'. $this->userKey);
        $form = $crawler->selectButton('Save')->form();
        $crawler = $this->client->submit($form, array(
            'BioversityUser[45]'  => 'utente prova edited-'. $this->userKey,
        ));
        
    }
    
    public function testDeleteAction()
    {
        $crawler = $this->client->request('GET', '/admin/manage-user/delete/utente_prova'. $this->userKey);
    }
}
