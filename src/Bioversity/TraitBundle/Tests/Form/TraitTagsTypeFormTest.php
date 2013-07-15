<?php

namespace Bioversity\TraitBundle\Tests\Form;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Bioversity\TraitBundle\Repository\TraitConnection;
use Bioversity\TraitBundle\Form\TraitTagsType;

class TraitTagsTypeFormTest extends WebTestCase
{
    public function testConstruct()
    {
        $server= new TraitConnection();
        
        $traits= $server->getTraits("Plant color");
        
        $form= new TraitTagsType($traits);
        
        $formFields= $form->getInternationlization();
        
        $this->assertTrue($formFields == array('GENESYSTRAIT543_130:882_882'));
    }
}