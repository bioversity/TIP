<?php

namespace Bioversity\ServerConnectionBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\TraitBundle\Repository\TraitConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\InputField;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsDEFAULT;

class InputFieldRepositoryTest extends WebTestCase
{
    private $modelClass;
    private $selectId= 211;
    private $rangeId= 526;
    private $defaultOptions;
    
    public function setUp()
    {
        $this->modelClass= new InputField();
        $this->defaultOptions= array(
                        'required' => true,
                        'label'    => '<strong>Country of origin</strong>',
                        'attr'     => array('title' => 'Code of the country in which the sample was originally collected.' ),
                        'constraints' => new ContainsDEFAULT()
                    );  
    }
    
    public function testGetInputField()
    {
        $select= $this->modelClass->getInputField($this->selectId, ':INPUT-CHOICE', $this->defaultOptions);
        
        $this->assertTrue($select['type'] == 'choice');
        $this->assertFalse(array_key_exists('class',$select['options']['attr']));
        
        $range= $this->modelClass->getInputField($this->rangeId, ':INPUT-RANGE', $this->defaultOptions);
        
        $this->assertTrue($range['type'] == 'text');
        $this->assertTrue($range['options']['attr']['class'] == 'range_field');
    }
    
    public function testGetOptions()
    {
        $select= $this->modelClass->getOptions($this->selectId);        
        $this->assertTrue(count($select) == 576);
        $this->assertTrue($select['ISO:3166:1:alpha-3:AFG'] == 'Afghanistan');
        $this->assertTrue($select['ISO:3166:3:alpha-3:ZAR'] == 'Zaire, Republic of');
        
        $range= $this->modelClass->getOptions($this->rangeId);
        $this->assertTrue(count($range) == 4);
        $this->assertTrue($range['GENESYS:SCALE:393:N'] == 'Day neutral');
        $this->assertTrue($range['GENESYS:SCALE:393:S'] == 'Day sensitive');
    }
}
