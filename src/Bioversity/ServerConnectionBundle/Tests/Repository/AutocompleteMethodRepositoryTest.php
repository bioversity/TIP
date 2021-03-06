<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\ServerConnectionBundle\Repository\AutocompleteMethod;

class AutocompleteMethodRepositoryTest extends WebTestCase
{
    private $repo;
    private $lid= 'OBJECT';
    private $label_for_trait= 'Rice tungro virus';
    private $trait= 'Flower ground color';
    private $gid= 'MCPD:INSTCODE';
    private $namespace= ':ONTOLOGY';
    private $label= 'Plant width in centimeters';
    
    protected function setUp()
    {
        $this->repo= new AutocompleteMethod();
    }
    
    public function testFindLID()
    {
        $response= $this->repo->findLID($this->lid, $this->namespace);
        $this->assertTrue($response == array (array (
            'GID' => ":ONTOLOGY:OBJECT",
            'LID' =>"OBJECT",
            'LABEL' =>"Object (:ONTOLOGY:OBJECT)")) );
    }
    
    public function testFindLABEL()
    {
        $response= $this->repo->findLABEL($this->label);
        $this->assertTrue($response == array (array ('GID' => "GENESYS:SCALE:525",'LID' =>"525",'LABEL' =>"Plant width in centimeters (GENESYS:SCALE:525)")) );
    }
    
    public function testFindNAMESPACE()
    {
        $response= $this->repo->findNAMESPACE($this->namespace);
        $this->assertTrue(in_array(array (
            'GID' => ":ONTOLOGY:ENUM:DOMAIN",
            'LID' =>"DOMAIN",
            'LABEL' =>"Domain (:ONTOLOGY:ENUM:DOMAIN)"), $response) );
    }
    
    public function testFindGID()
    {
        $response= $this->repo->findGID($this->gid);
        $this->assertTrue($response == array (array ('GID' => $this->gid,'LID' =>"INSTCODE",'LABEL' =>"Holding institute code (MCPD:INSTCODE)")) );
    }
    
    public function testFindTrait()
    {
        $response= $this->repo->findTrait($this->trait);
        $this->assertTrue($response == array (array ('GID' => 'GENESYS:TRAIT:221','LID' =>"221",'LABEL' =>"Flower ground color (GENESYS:TRAIT:221)")) );
    }
    
    public function testFindTagByLabel()
    {
        $response= $this->repo->findTrait($this->trait);
        $this->assertTrue($response == array (array ('GID' => 'GENESYS:TRAIT:221','LID' =>"221",'LABEL' =>"Flower ground color (GENESYS:TRAIT:221)")) );
    }
}