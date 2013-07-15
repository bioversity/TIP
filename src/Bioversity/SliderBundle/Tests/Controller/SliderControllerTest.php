<?php

namespace Bioversity\SliderBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SliderControllerTest extends WebTestCase
{
    private $client;
    private $potData=  array('SliderSearchNode[19]' => 'Plant size',
                             'SliderSearchNode[2]' => 'GENESYS:TRAIT:554');
    
    public function setUp()
    {        
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
    }
    
    public function testBrowseSliderAction()
    {
        $crawler = $this->client->request('GET', '/browse-slider');

        $this->assertTrue($crawler->filter('html:contains("Start from root node")')->count() > 0);
    }
    
    public function testPartialNodeSearchAction()
    {
        $crawler1 = $this->client->request('GET', '/slider/partial/node/search/1');
        $form = $crawler1->selectButton('Search')->form();
        $crawler2 = $this->client->submit($form, $this->potData);
        
        $this->assertTrue($crawler2->text() == '{"term":{":WS:STATUS":{":STATUS-LEVEL":0,":STATUS-CODE":0,":WS:AFFECTED-COUNT":2},":WS:REQUEST":{":WS:FORMAT":":JSON",":WS:OPERATION":"WS:OP:GET",":WS:DATABASE":"TEST-ONTOLOGY",":WS:CONTAINER":":_nodes",":WS:PAGE-START":0,":WS:QUERY":{"$AND":[{"_query-subject":2,"_query-operator":"$EQ","_query-data-type":":STRING","_query-data":"GENESYS:TRAIT:554"}]}},":WS:PAGING":{":WS:PAGE-START":0,":WS:PAGE-LIMIT":50,":WS:PAGE-COUNT":2},":WS:RESPONSE":[{"_id":18487,"1":"554","2":"GENESYS:TRAIT:554","19":{"en":"Plant size"},"9":[":KIND-FEATURE"],"29":{"type":":BINARY","data":"2070b15e65df95f18c2a924ff8c8c30f"},"11":"COntologyMasterVertex"},{"_id":25217,"1":"554","2":"GENESYS:TRAIT:554","19":{"en":"Plant size"},"42":[575],"29":{"type":":BINARY","data":"2070b15e65df95f18c2a924ff8c8c30f"},"4":"GENESYS:PARAMETER:505","131":"505","11":"COntologyAliasVertex","30":18487}]}}');
    }
    
    public function testModalSliderAction()
    {
    }
    
    public function testJsonRootNodeAction()
    {
        $crawler = $this->client->request('GET', '/get-root-nodes');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == false);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
    
    public function testJsonNodeRelationsAction()
    {
    }
    
    public function testJsonNodeDetailsAction()
    {
        $crawler = $this->client->request('GET', '/get-node-details/18491');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == false);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
    
    public function testJsonNodeRelationINAction()
    {
        $crawler = $this->client->request('GET', '/get-node-relation-in/18491');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
    
    public function testJsonNodeRelationOUTAction()
    {
        $crawler = $this->client->request('GET', '/get-node-relation-out/17453');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
    
    public function testJsonSearchNodeRelationINAction()
    {
        $crawler = $this->client->request('GET', '/search-node-relation-in/18491/plant%20width%20in%20centimeters');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
    
    public function testJsonSearchNodeRelationOUTAction()
    {
        $crawler = $this->client->request('GET', '/search-node-relation-out/18491/morphology');
        
        $response= json_decode($crawler->text());
        
        $this->assertTrue($response->{':WS:STATUS'}->{':WS:AFFECTED-COUNT'} > 0);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_ids'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_term'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_node'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_edge'} == true);
        $this->assertTrue($response->{':WS:RESPONSE'}->{'_tag'} == true);
    }
}
