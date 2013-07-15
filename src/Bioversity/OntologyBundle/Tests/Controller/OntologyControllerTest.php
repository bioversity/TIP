<?php

namespace Bioversity\OntologyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class OntologyControllerTest extends WebTestCase
{
    private $client;
    
    public function setUp()
    {        
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
    }
    
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/ontology/browse-slider');

        $this->assertTrue($crawler->filter('html:contains("Start from root node")')->count() > 0);
    }
    
    public function testNewTermAction()
    {
        $crawler = $this->client->request('GET', '/ontology/term/new');
        
        $this->assertTrue($crawler->filter('input#OntologyTerm_12')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_1')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_19')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyTerm_20')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_5')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_8')->count() > 0);
        
        //TODO: we need to test the submit
    }
    
    public function testNewPredicateAction()
    {
        $crawler = $this->client->request('GET', '/ontology/predicate/new/LR:PPU:10');

        $this->assertTrue($crawler->filter('input#OntologyPredicate_12')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_1')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_19')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyPredicate_20')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_5')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_8')->count() > 0);
        
        //TODO: we need to test the submit
    }
    
    public function testNewNodeAction()
    {
        $crawler = $this->client->request('GET', '/ontology/node/new/LR:PPU:10');

        $this->assertTrue($crawler->filter('textarea#OntologyNode_21')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyNode_23')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_16')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_17')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_9')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_9 div')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_10')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_10 div')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_15')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_8')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_14')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_4')->count() > 0);
        $this->assertTrue($crawler->filter('select#OntologyNode_13')->count() > 0);
        
        //TODO: we need to test the submit
    }
    
    public function testPartialNewTermAction()
    {
        $crawler = $this->client->request('GET', '/ontology/term/new');
    
        $this->assertTrue($crawler->filter('input#OntologyTerm_12')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_1')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_19')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyTerm_20')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_5')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyTerm_8')->count() > 0);
    }
    
    public function testPartialNewPredicateAction()
    {
        $crawler = $this->client->request('GET', '/ontology/partial/predicate/new');
    
        $this->assertTrue($crawler->filter('input#OntologyPredicate_12')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_1')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_19')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyPredicate_20')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_5')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyPredicate_8')->count() > 0);
        
        //TODO: we need to test the submit
    }
    
    public function testPartialNewNodeAction()
    {
        $crawler = $this->client->request('GET', '/ontology/partial/node/new/LR:PPU:10');
    
        $this->assertTrue($crawler->filter('textarea#OntologyNode_21')->count() > 0);
        $this->assertTrue($crawler->filter('textarea#OntologyNode_23')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_16')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_17')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_9')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_9 div')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_10')->count() > 0);
        $this->assertTrue($crawler->filter('div#OntologyNode_10 div')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_15')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_8')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_14')->count() > 0);
        $this->assertTrue($crawler->filter('input#OntologyNode_4')->count() > 0);
        $this->assertTrue($crawler->filter('select#OntologyNode_13')->count() > 0);
        
        //TODO: we need to test the submit
    }
    
    public function testJsonNewPredicateAction()
    {
        $crawler = $this->client->request('GET', '/ontology/json/term/new');
        
        $this->assertTrue($crawler->filter('html:contains("term")')->count() > 0);
    }
    
}
