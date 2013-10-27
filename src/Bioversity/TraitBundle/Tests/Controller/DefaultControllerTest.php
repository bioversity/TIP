<?php

namespace Bioversity\TraitBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;
    private $potData=  array('GENESYSTRAIT802_130:928_928_enabler' => 'enable',
                             'GENESYSTRAIT802_130:928_928' => array('',''),
                             'page' => 0 );
    private $url= 'http://temp.wrapper.grinfo.net/TIP/Wrapper.test.php?:WS:OPERATION=WS:OP:GetAnnotated&:WS:FORMAT=:JSON&:WS:DATABASE=%22PGRSECURE%22&:WS:DATABASE-BIS=%22ONTOLOGY%22&:WS:CONTAINER=%22%3A_units%22&:WS:QUERY=%7B%22%24AND%22%3A%5B%7B%22%24OR%22%3A%5B%7B%22%24AND%22%3A%5B%7B%22_query-subject%22%3A%2240%22%2C%22_query-operator%22%3A%22%24EQ%22%2C%22_query-data-type%22%3A%22%3AINT%22%2C%22_query-data%22%3A461%7D%5D%7D%5D%7D%2C%7B%22%24OR%22%3A%5B%7B%22%24AND%22%3A%5B%7B%22%24OR%22%3A%5B%7B%22_query-subject%22%3A%226%22%2C%22_query-operator%22%3A%22%24EQ%22%2C%22_query-data-type%22%3A%22%3ASTRING%22%2C%22_query-data%22%3A%22%3ADOMAIN-ACCESSION%22%7D%5D%7D%5D%7D%5D%7D%5D%7D&:WS:LOG-REQUEST=1&:WS:PAGE-START=0';
    
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
        print_r('!!!!!!!!!!TODO: find a solution to send param in json format!!!!!!!!!!');
    //    $crawler = $this->client->request('POST',
    //                                      '/trait/json/get/tag/fields',
    //                                      array(),
    //                                      array(),
    //                                      array('CONTENT_TYPE' => 'application/json'),
    //                                      '{"word":"Relative plant size"}');
    //
    //    $this->assertTrue($crawler->filter('html:contains("Relative plant size")')->count() > 0);
    //    $this->assertTrue($crawler->filter('input[type=checkbox]')->count() > 0);
    }
    
    public function testJsonFindSummaryTraits()
    {
        $crawler = $this->client->request('POST','/trait/json/find/summary/trait',$this->potData);

        $this->assertTrue($crawler->filter('.distinct_value')->count() > 0);
    }
    
    public function testJsonFindTraits()
    {
        $crawler = $this->client->request('POST','/trait/json/find/trait',array('url' => $this->url));

        $this->assertTrue($crawler->filter('html:contains("Accession")')->count() > 0);
        $this->assertTrue($crawler->filter('html:contains("Trial")')->count() > 0);
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
