<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerQueryRepositoryTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    private $objectClass;
    
    public function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
        $this->objectClass= $this->serverResponseClass->getRequest();
    }
    
    public function testClass()
    {
        $this->assertTrue(get_class($this->objectClass) == 'Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestManager' );
    }
    
    public function testQuery()
    {
        $query= $this->serverResponseClass->getRequest()->getQuery()->getQuery();
        
        $this->assertTrue($query == array(
                        '_query-subject'  => '',
                        '_query-operator' => '',
                        '_query-data-type'=> '',
                        '_query-data'     => '')
                        );
     }
    
    public function testQuerySubject()
    {
        $querySubject= $this->serverResponseClass->getRequest()->getQuery()->getQuerySubject();
        $this->assertTrue( $querySubject ==  '');
    }
    
    public function testQueryOperator()
    {
        $queryOperator= $this->serverResponseClass->getRequest()->getQuery()->getQueryOperator();
    
        $this->assertTrue($queryOperator ==  '');
    }
    
    public function testQueryDataType()
    {
        $queryDataType = $this->serverResponseClass->getRequest()->getQuery()->getQueryDataType();
        $this->assertTrue($queryDataType ==  '');
    }
    
    public function testQueryData()
    {
        $queryData= $this->serverResponseClass->getRequest()->getQuery()->getQueryData();
    
        $this->assertTrue($queryData     ==  '');
    }
}
