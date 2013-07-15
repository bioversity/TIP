<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\SecurityBundle\Repository\ServerConnection;

class ServerConnectionTest extends WebTestCase
{
    private $username= 'admin';
    private $userKey;
    private $userObject;
    private $updatedUserObject;
    private $userID;
    
    protected function setUp()
    {
        $this->repo= new ServerConnection();
        $this->userKey= str_replace(':','_',date('Y-m-d-h:i:s'));
        $this->userID= 'utente_prova'. $this->userKey;
        
        $this->userObject= Array(   45  => 'utente prova-'. $this->userKey,
                                    46  => 'utente_prova'. $this->userKey,
                                    47  => 'utente_prova',
                                    48  => 'utente@prova.com',
                                    49  => array('ROLE_ADMIN'),
                                    53  => 'institute code',
                                    54  => 'institute name',
                                    55  => 'institute address',);
        $this->updatedUserObject= Array(45  => 'utente prova-'. $this->userKey.'_updated',
                                        46  => 'utente_prova'. $this->userKey,
                                        47  => 'utente_prova',
                                        48  => 'utente@prova.com',
                                        49  => array('ROLE_ADMIN'),
                                        53  => 'institute code',
                                        54  => 'institute name',
                                        55  => 'institute address',);
    }
    
    public function testFindUserForAuthentication()
    {
        $response= $this->repo->findUserForAuthentication($this->username);

        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
        $this->assertTrue($response->getResponse()->getKey(45) == 'System Administrator');
        $this->assertTrue($response->getResponse()->getKey(46) == 'admin');
        $this->assertTrue($response->getResponse()->getKey(47) == 'nimda');
        $this->assertTrue($response->getResponse()->getKey(48) == 'admin@eurisco.com');
        $this->assertTrue($response->getResponse()->getKey(49) == array('ROLE_ADMIN'));
        $this->assertTrue($response->getResponse()->getKey('_id') == 'admin');
    }
    
    public function testGetUserList()
    {
        $response= $this->repo->getUserList();
        
        $this->assertTrue($response->getStatus()->getAffectedCount() >= 1 );
        foreach($response->getResponse() as $key=>$user){
            $this->assertTrue($user[$key]->getKey(45));
            $this->assertTrue($user[$key]->getKey(46));
            $this->assertTrue($user[$key]->getKey(47));
            $this->assertTrue($user[$key]->getKey(48));
            $this->assertTrue($user[$key]->getKey(49));
            $this->assertTrue($user[$key]->getKey('_id'));
        }
    }
    
    public function testSaveNewUser()
    {
        $response= $this->repo->saveNewUser($this->userObject, array('ROLE_ADMIN'));
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
    }
    
    public function testUpdateNewUser()
    {
        $response= $this->repo->updateNewUser($this->updatedUserObject);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
    }
    
    public function testDeleteUser()
    {
        $response= $this->repo->deleteUser($this->userID);
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 1 );
    }
}