<?php

namespace Bioversity\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\SecurityBundle\Controller\SecurityController;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Bioversity\SecurityBundle\Repository\User\WebserviceUserProvider;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class SecurityControllerTest extends WebTestCase
{
    private $client;
    
    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
    }
    
    public function testLogin()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('_username' => 'admin', '_password' => 'nimda'));
        
        $client->followRedirects();        
    }
    
    //public function testRegistration()
    //{
    //    $crawler = $this->client->request('GET', '/registration');
    //    
    //    $form = $crawler->selectButton('Save')->form();
    //    $crawler = $this->client->submit($form, array(
    //        'BioversityUserRegistration[45]'  => 'utente prova',
    //        'BioversityUserRegistration[46]'  => 'utemte_prova',
    //        'BioversityUserRegistration[47]'  => 'utemte_prova',
    //        'BioversityUserRegistration[48]'  => 'utemte@prova.com',
    //        'BioversityUserRegistration[53]'  => 'institute code',
    //        'BioversityUserRegistration[54]'  => 'institute name',
    //        'BioversityUserRegistration[55]'  => 'institute address',
    //        'BioversityUserRegistration[56]'  => '',
    //        'BioversityUserRegistration[roles]'     => array('ROLE_DATA') //this field is out of requirement
    //    ));
    //    
    //    $crawler= $this->client->followRedirects();
    //    print_r($crawler);
    //}
    
    public function testWSresponce()
    {
        $ws= new ServerConnection();
        $crawler = $ws->findUserForAuthentication('admin');
        
        $this->assertEquals('nimda', $crawler->getResponse()->getAllResponse()[Tags::kTAG_USER_PASS]);
    }
}
