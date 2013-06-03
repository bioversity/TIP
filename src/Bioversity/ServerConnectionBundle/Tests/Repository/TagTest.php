<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class TagRepositoryTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    
    //public function setUp()
    //{
    //    $this->mokedResponseClass= new MokResponse();
    //    $this->mokedResponse= $this->mokedResponseClass->getResponse();
    //    $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
    //}
    
    public function testGetTag()
    {
        $tagClass= new Tags();
        $tag= $tagClass->getTagBy('GR:TAXON', Tags::kTAG_GID);
        
        $this->assertTrue($tag->getStatus()->getAffectedCount()  ==  1);
        $this->assertTrue($tag->getResponse()->getIds()  ==  array(93));
        
        $tag= $tagClass->getTagBy('GR:TAXON', Tags::kTAG_NID);
        
        $this->assertTrue($tag->getStatus()->getAffectedCount()  ==  0);
        
    }
}
