<?php

namespace Bioversity\TraitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;
    private $potData=  array('GENESYSTRAIT802_130:928_928_enabler' => 'enable',
                             'GENESYSTRAIT802_130:928_928' => array('',''),
                             'page' => 0 );
    
    public function setUp()
    {
        $this->client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'nimda',
        ));
    }
    
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/trait/browse');

        $this->assertTrue($crawler->filter('html:contains("Trait")')->count() > 0);
        $this->assertTrue($crawler->filter('form#searchTrait')->count() > 0);
    }
    
    public function testJsonGetTagFields()
    {
        $word= serialize("Relative plant size");
        $crawler = $this->client->request('POST',
                                          '/trait/json/get/tag/fields',
                                          array(),
                                          array(),
                                          array('CONTENT_TYPE' => 'application/json'),
                                          "{word:$word}");

        $this->assertTrue($crawler->filter('html:contains("Relative plant size")')->count() > 0);
        $this->assertTrue($crawler->filter('input[type=checkbox]')->count() > 0);
    }
    
    public function testJsonFindTraits()
    {
        $crawler = $this->client->request('POST','/trait/json/find/trait',$this->potData);

        $this->assertTrue($crawler->filter('html:contains("We have found 2881 results")')->count() > 0);
    }
    
    public function testJsonGetTrials()
    {
        $crawler = $this->client->request('GET','/modal-trial/1/130/%253ADOMAIN-ACCESSION%253A%252F%252FUSA016%252F1552134%253B');

        $this->assertTrue($crawler->filter('div.accordion-heading')->count() == 2);
    }
    
    public function testJsonGetTrialDetail()
    {
        $crawler = $this->client->request('GET','modal-trial-detail/%253ADOMAIN-TRIAL%253A%252F%252FUSA%252F1058%253B');
                                                
        $this->assertTrue($crawler->filter('div#content_body div')->count() > 0);
    }
}
