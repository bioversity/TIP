<?php

namespace Bioversity\SecurityBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Bioversity\ServerConnectionBundle\Form\BioversityBaseType;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class BioversityUserType extends BioversityBaseType
{

    public function getName()
    {
        return 'BioversityUser';
    }
    
    var $internationlization= array(
        Tags::kTAG_NAME,
        Tags::kTAG_USER_CODE,
        Tags::kTAG_USER_PASS,
        Tags::kTAG_EMAIL,
        Tags::kTAG_NATIONALITY
    );
     
    public function __construct()
    {        
        $this->setInternationlization($this->internationlization);
    }
    
    public function getFields(){
        return $this->internationlization;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(Tags::kTAG_USER_ROLE, 'choice', array(
            'choices'   => array(
                'ROLE_ADMIN'    => 'Admin Role',
                'ROLE_DATA'     => 'Data Entry Role',
                'ROLE_ONTOLOGY' => 'Ontology Curator Role',
                'ROLE_GUEST'    => 'Test User',
                ),
            'required' => true,
            'multiple' => true,
            'expanded' => true,
            'label' => 'Roles'
            ));
        
        parent::buildForm($builder, $options);
    }

    private function refactorRoles($originRoles)
    {
        $roles = array('');
        $rolesAdded = array();
    
        // Add herited roles
        foreach ($originRoles as $roleParent => $rolesHerit) {
            $tmpRoles = array_values($rolesHerit);
            $rolesAdded = array_merge($rolesAdded, $tmpRoles);
            $roles[$roleParent] = array_combine($tmpRoles, $tmpRoles);
        }
        // Add missing superparent roles
        $rolesParent = array_keys($originRoles);
        foreach ($rolesParent as $roleParent) {
            if (!in_array($roleParent, $rolesAdded)) {
                $roles['-----'][$roleParent] = $roleParent;
            }
        }
    
        return $roles;
    }
}