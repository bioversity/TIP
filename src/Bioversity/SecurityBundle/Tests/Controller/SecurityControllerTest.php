<?php

namespace Bioversity\SecurityBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\SecurityBundle\Controller\SecurityController;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Bioversity\SecurityBundle\Repository\User\WebserviceUserProvider;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class SecurityControllerTest extends WebTestCase
{
    
    public function testLogin()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('_username' => 'admin', '_password' => 'nimda'));
        
        $client->followRedirects();        
    }
    
    public function testRegistration()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/registration');
        $form = $crawler->selectButton('Save')->form();
        $crawler = $client->submit($form, array(
            'BioversityUserRegistration[fullname]'  => 'utente prova',
            'BioversityUserRegistration[username]'  => 'utemte_prova',
            'BioversityUserRegistration[password]'  => 'utemte_prova',
            'BioversityUserRegistration[email]'     => 'utemte@prova.com',
            'BioversityUserRegistration[roles]'     => array('ROLE_DATA')
        ));
        
        $client->followRedirects();        
    }
    
    public function testWSresponce()
    {
        $ws= new ServerConnection();
        $crawler = $ws->findUserForAuthentication('admin');
        
        $this->assertEquals('nimda', $crawler[':WS:RESPONSE'][Tags::kTAG_USER_PASS]);
    }
}
