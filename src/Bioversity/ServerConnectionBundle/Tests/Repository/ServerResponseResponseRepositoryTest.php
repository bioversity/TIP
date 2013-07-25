<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Tests\MokClass\MokResponse;

class ServerResponseResponseRepositoryTest extends WebTestCase
{
    private $mokedResponse;
    private $mokedResponseClass;
    
    public function setUp()
    {
        $this->mokedResponseClass= new MokResponse();
        $this->mokedResponse= $this->mokedResponseClass->getResponse();
        $this->serverResponseClass= new ServerResponseManager($this->mokedResponse);
    }
    
    public function testClassHierarchy()
    {   
        $ids      = $this->serverResponseClass->getResponse()->getIds();
        $tag      = $this->serverResponseClass->getResponse()->getTag();
        $term     = $this->serverResponseClass->getResponse()->getTerm();
        $unit     = $this->serverResponseClass->getResponse()->getUnit();
        $edge     = $this->serverResponseClass->getResponse()->getEdge();
        $node     = $this->serverResponseClass->getResponse()->getNode();
        $distinct = $this->serverResponseClass->getResponse()->getDistinct();
        
        $this->assertTrue($ids    == array(1,271));
        $this->assertTrue(array_key_exists('19', $tag));
        $this->assertTrue($tag['19'] == array(
                                            '35'=>array(':LABEL'),
                                            '5'=>array('kTERM_LABEL'),
                                            '10'=>array(':LSTRING'),
                                            '13'=>':INPUT-TEXT',
                                            '37'=>0,
                                            '41'=>array()
                                          ));
        $this->assertTrue(array_key_exists(':ONTOLOGY', $term));
        $this->assertTrue($unit == null);
        $this->assertTrue($edge == array());
        $this->assertTrue(array_key_exists('1', $node));
        $this->assertTrue($node['1'] == array(
                                            '2'=>':ONTOLOGY',
                                            '19'=>array('en'=>'Ontology'),
                                            '20'=>array('en'=>'An ontology is a graph structure'),
                                            '9'=>array(':KIND-ROOT'),
                                            '21'=>array('en'=>'This represents the default ontology')
                                          ));
        $this->assertTrue(count($distinct) == 1);
        $this->assertTrue(count($distinct->getTagsValues($distinct->getTags()[0])) == 5);
    }
}
