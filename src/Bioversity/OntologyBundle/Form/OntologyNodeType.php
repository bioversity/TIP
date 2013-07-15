<?php

namespace Bioversity\OntologyBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class OntologyNodeType extends BioversityBaseType
{  
    public function __construct()
    {
        $internationalization= array(
				    Tags::kTAG_DESCRIPTION,
				    Tags::kTAG_EXAMPLES,
				    Tags::kTAG_MIN_VAL,
				    Tags::kTAG_MAX_VAL,
				    Tags::kTAG_KIND,
				    Tags::kTAG_TYPE,
				    Tags::kTAG_LENGTH,
				    Tags::kTAG_CATEGORY,
				    Tags::kTAG_PATTERN,
				    Tags::kTAG_PID,
				    Tags::kTAG_INPUT,
				);
        
        $this->setInternationlization($internationalization);
    }

    public function getName()
    {
        return 'OntologyNode';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options){
        parent::buildForm($builder, $options);
        
        $nodeList= array();
        $this->manageNodeFormException($nodeList, $builder, $options);
    }
    
    public function manageNodeFormException($nodeList, $builder, $options)
    {
        if($this->getName()=='OntologyNode'){
            foreach($options['data']['nodes'] as $node){
                $nodeList[]= array($node[Tags::kTAG_NID]=>$node[Tags::kTAG_NID]);
            }
            
            if(count($nodeList) > 0){
                $builder->add(
                    'node_related',
                    'choice',
                    array(
                        'choices' => $nodeList,
                        'expanded' => true,
                        'multiple' => false,
                        'required' => false
                    )
                );
                
                $builder->add(
                    'node_class',
                    'hidden',
                    array(
                        'data' => 'COntologyAliasVertex'
                    )
                );
            }else{                
                $builder->add(
                    'node_class',
                    'hidden',
                    array(
                        'data' => 'COntologyMasterVertex'
                    )
                );
            }
        }
    }
}