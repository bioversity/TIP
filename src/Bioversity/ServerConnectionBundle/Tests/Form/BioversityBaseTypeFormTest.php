<?php

namespace Bioversity\ServerConnectionBundle\Tests\Form;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\TraitBundle\Repository\TraitConnection;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;

class BioversityBaseTypeFormTest extends WebTestCase
{
    private $traitConnection;
    private $baseForm;
    private $fields= array(
                        'GENESYSTRAIT558_258:545_545',
                        'GENESYSTRAIT558_258:300_300',
                        'GENESYSTRAIT558_258:963_963',
                        'GENESYSTRAIT558_258:686_686',
                       );
    private $field= 'MCPDORIGCTY_211';
    
    public function setUp()
    {
        $this->traitConnection= new TraitConnection();
        $this->baseForm= new BioversityBaseType();
    }
    
    public function testBuildForm()
    {   
    }
    
    public function testGetValidator()
    {
        $validator= $this->baseForm->getValidator(':NAMESPACE');
        $validatorPath= $this->baseForm->getValidatorPath();
        
        $this->assertTrue(get_class($validator) == $validatorPath.'NAMESPACE');
    }
    
    public function testGetLabel()
    {
        $this->baseForm->setInternationlization($this->fields);
        $response= $this->baseForm->getLabel();
        
        $this->assertTrue($response->getStatus()->getAffectedCount() == 4);
        $this->assertTrue($response->getResponse()->getIds() == array(300,545,686,963));
        $this->assertTrue(count(array_keys($response->getResponse()->getTerm())) == 21);
        $this->assertTrue($response->getResponse()->getNode() == array());
        $this->assertTrue($response->getResponse()->getEdge() == array());
        $this->assertTrue(count($response->getResponse()->getTag()) == 16);
    }
    
    public function testGetInputType()
    {
        $this->baseForm->setInternationlization($this->fields);
        $response= $this->baseForm->getLabel();
        $terms= $response->getResponse()->getTerm();
        $tags = $response->getResponse()->getTag();
        
        $reflection = new \ReflectionClass(get_class($this->baseForm));
        $method = $reflection->getMethod('getInputType');
        $method->setAccessible(true);

        $result= array();
        foreach($this->fields as $field){
            $result[]= $method->invokeArgs($this->baseForm, array($field, $terms, $tags));
        }
        
        $this->assertTrue($result[0]['type'] == 'choice');
        $this->assertTrue($result[0]['options']['required'] == '');
        $this->assertTrue($result[0]['options']['label'] == '<strong>Leaf pubescence</strong> <br/> <i>Observed before maturity</i>');
        $this->assertTrue($result[0]['options']['attr']['title'] == '');
        $this->assertTrue($result[0]['options']['attr']['class'] == 'tree');
        $this->assertTrue(get_class($result[0]['options']['constraints'][0]) == 'Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsDEFAULT');
        $this->assertTrue($result[0]['options']['choices'] == array(
                                                                    'GENESYS:SCALE:412:1' => 'ABSENT',
                                                                    '0' => Array(),
                                                                    'GENESYS:SCALE:412:3' => 'SLIGHT',
                                                                    '1' => Array(),
                                                                    'GENESYS:SCALE:412:5' => 'INTERMEDIATE',
                                                                    '2' => Array(),
                                                                    'GENESYS:SCALE:412:7' => 'DENSE',
                                                                    '3' => Array(),
                                                                    'GENESYS:SCALE:412:9' => 'VERY DENSE',
                                                                    '4' => Array(),
                                                                    'GENESYS:SCALE:412:M' => 'MIX',
                                                                    '5' => Array()
                                                                    ));
        
    }
    
    public function testSetOptions()
    {
        $this->baseForm->setInternationlization(array($this->field));
        $response= $this->baseForm->getLabel();
        $terms= $response->getResponse()->getTerm();
        $tags = $response->getResponse()->getTag();
        
        $reflection = new \ReflectionClass(get_class($this->baseForm));
        $method = $reflection->getMethod('setOptions');
        $method->setAccessible(true);

        $tag= $this->baseForm->clearTag($this->field);
        $result= $method->invokeArgs($this->baseForm, array($terms, $tags, $tag));
        
        $this->assertTrue($result['required'] == '');
        $this->assertTrue($result['label'] == '<strong><i>Country of origin</i></strong>');
        $this->assertTrue($result['attr']['title'] == 'Code of the country in which the sample was originally collected.');
        $this->assertTrue(get_class($result['constraints'][0]) == 'Bioversity\ServerConnectionBundle\Validator\Constraints\ContainsDEFAULT');
        
    }
    
    public function testGetAttrTitle()
    {
        $this->baseForm->setInternationlization(array($this->field));
        $response= $this->baseForm->getLabel();
        $terms= $response->getResponse()->getTerm();
        $tags = $response->getResponse()->getTag();
        
        $reflection = new \ReflectionClass(get_class($this->baseForm));
        $method = $reflection->getMethod('getAttrTitle');
        $method->setAccessible(true);

        $definition= $terms[$tags['211'][Tags::kTAG_PATH][count($tags['211'][Tags::kTAG_PATH])-1]][Tags::kTAG_DEFINITION];
        $result= $method->invokeArgs($this->baseForm, array($definition));
        
        $this->assertTrue($result== 'Code of the country in which the sample was originally collected.');
    }
    
    public function testGetFieldName()
    {
        $reflection = new \ReflectionClass(get_class($this->baseForm));
        $method = $reflection->getMethod('getFieldName');
        $method->setAccessible(true);
        
        $this->baseForm->setInternationlization(array($this->field));
        $response= $this->baseForm->getLabel();
        $terms= $response->getResponse()->getTerm();
        $tags = $response->getResponse()->getTag();

        $result= $method->invokeArgs($this->baseForm, array($terms, $tags, 211));
        
        $this->assertTrue($result== '<strong><i>Country of origin</i></strong>');
    }
    
    public function testClearTag()
    {
        $tag= $this->baseForm->clearTag($this->field);
        
        $this->assertTrue($tag == 211);
    }
    
    public function testClearTags()
    {
        $tag= $this->baseForm->clearTags($this->fields);
        
        $this->assertTrue($tag == array(545,300,963,686,));
    }
    
}