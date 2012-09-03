<?php

namespace Bioversity\AttributefieldsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bioversity\AttributefieldsBundle\Document\Term;

class LoadTermData implements FixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $initEntity= array(
      array(
        '_idx'        => '',
        '_ns'         => 'NULL',
        '_code'       => '',
        'label'       => 'Default namespace',
        'description' => 'Namespace of all elements comprising the application.',
      ),
      array(
        '_idx'        => ':LABEL',
        '_ns'         => '',
        '_code'       => 'LABEL',
        'label'       => 'Label',
        'description' => 'Short description or name.',
      ),
      array(
        '_idx'        => ':DESCRIPTION',
        '_ns'         => '',
        '_code'       => 'DESCRIPTION',
        'label'       => 'Description',
        'description' => 'Long description or definition.',
      ),
      array(
        '_idx'        => ':CODE',
        '_ns'         => '',
        '_code'       => 'CODE',
        'label'       => 'Code',
        'description' => 'Abbreviation or acronym used to identify an object.',
      ),
      array(
        '_idx'        => ':PASSWORD',
        '_ns'         => '',
        '_code'       => 'PASSWORD',
        'label'       => 'Password',
        'description' => 'Code used to validate an object.',
      ),
      array(
        '_idx'        => ':NAME',
        '_ns'         => '',
        '_code'       => 'NAME',
        'label'       => 'Name',
        'description' => 'Label used to identify an object.',
      ),
      array(
        '_idx'        => ':EMAIL',
        '_ns'         => '',
        '_code'       => 'EMAIL',
        'label'       => 'E-mail',
        'description' => 'E-mail address.',
      ),
      array(
        '_idx'        => ':ROLE',
        '_ns'         => '',
        '_code'       => 'ROLE',
        'label'       => 'Role',
        'description' => 'Role or responsibility.',
      ),
      array(
        '_idx'        => ':PERMISSIONS-USER',
        '_ns'         => '',
        '_code'       => 'PERMISSIONS-USER',
        'label'       => 'User permissions',
        'description' => 'List of permissions or capabilities related to users.',
      ),
      array(
        '_idx'        => ':PERMISSIONS-PASSPORT',
        '_ns'         => '',
        '_code'       => 'PERMISSIONS-PASSPORT',
        'label'       => 'Passport dataset permissions',
        'description' => 'List of permissions or capabilities related to passport datasets.',
      ),
      array(
        '_idx'        => ':PERMISSIONS-DATASET',
        '_ns'         => '',
        '_code'       => 'PERMISSIONS-DATASET',
        'label'       => 'Dataset permissions',
        'description' => 'List of permissions or capabilities related to datasets.',
      ),
      array(
        '_idx'        => ':STRING',
        '_ns'         => '',
        '_code'       => 'STRING',
        'label'       => 'String',
        'description' => 'String data type.',
      ),
      array(
        '_idx'        => ':ENUM',
        '_ns'         => '',
        '_code'       => 'ENUM',
        'label'       => 'Enumeration',
        'description' => 'Enumerated value.',
      ),
      array(
        '_idx'        => ':SET',
        '_ns'         => '',
        '_code'       => 'SET',
        'label'       => 'Enumerated set',
        'description' => 'List of non-repeating enumerated values.',
      ),
      array(
        '_idx'        => ':USER',
        '_ns'         => '',
        '_code'       => 'USER',
        'label'       => 'User',
        'description' => 'User entity.',
      ),
      array(
        '_idx'        => ':ROOT',
        '_ns'         => '',
        '_code'       => 'ROOT',
        'label'       => 'Root',
        'description' => 'Graph root node or entry point.',
      ),
      array(
        '_idx'        => ':TRAIT',
        '_ns'         => '',
        '_code'       => 'TRAIT',
        'label'       => 'Trait',
        'description' => 'Trait or measurable characteristic.',
      ),
      array(
        '_idx'        => ':METHOD',
        '_ns'         => '',
        '_code'       => 'METHOD',
        'label'       => 'Method',
        'description' => 'Method or measurement workflow.',
      ),
      array(
        '_idx'        => ':SCALE',
        '_ns'         => '',
        '_code'       => 'SCALE',
        'label'       => 'Scale',
        'description' => 'Scale or measurement unit.',
      ),
      array(
        '_idx'        => ':ATTRIBUTE-OF',
        '_ns'         => '',
        '_code'       => 'ATTRIBUTE-OF',
        'label'       => 'Attribute-of',
        'description' => 'Predicate indicating an attribute-of relationship.',
      ),
      array(
        '_idx'        => ':ENUM-OF',
        '_ns'         => '',
        '_code'       => 'ENUM-OF',
        'label'       => 'Enumeration-of',
        'description' => 'Predicate indicating an enumeration-of relationship.',
      ),
      array(
        '_idx'        => ':ADMIN',
        '_ns'         => '',
        '_code'       => 'ADMIN',
        'label'       => 'Administrator',
        'description' => 'The user that is responsible of the administration.',
      ),
      array(
        '_idx'        => ':CATALOGUE-USER',
        '_ns'         => '',
        '_code'       => 'CATALOGUE-USER',
        'label'       => 'Catalogue user',
        'description' => 'The user that is responsible of the catalogue.',
      ),
      array(
        '_idx'        => ':INVENTORY-USER',
        '_ns'         => '',
        '_code'       => 'INVENTORY-USER',
        'label'       => 'Inventory user',
        'description' => 'The user that is responsible of the inventory.',
      ),
      array(
        '_idx'        => ':COLLECTION-USER',
        '_ns'         => '',
        '_code'       => 'COLLECTION-USER',
        'label'       => 'Collection user',
        'description' => 'The user that is responsible of the collection.',
      ),
      array(
        '_idx'        => ':GENERIC-USER',
        '_ns'         => '',
        '_code'       => 'GENERIC-USER',
        'label'       => 'Generic user',
        'description' => 'A generic user.',
      ),
      array(
        '_idx'        => ':CREATE',
        '_ns'         => '',
        '_code'       => 'CREATE',
        'label'       => 'Create',
        'description' => 'Can create.',
      ),
      array(
        '_idx'        => ':LIST',
        '_ns'         => '',
        '_code'       => 'LIST',
        'label'       => 'List',
        'description' => 'Can list.',
      ),
      array(
        '_idx'        => ':READ',
        '_ns'         => '',
        '_code'       => 'READ',
        'label'       => 'Read',
        'description' => 'Can read.',
      ),
      array(
        '_idx'        => ':MODIFY',
        '_ns'         => '',
        '_code'       => 'MODIFY',
        'label'       => 'Modify',
        'description' => 'Can modify.',
      ),
      array(
        '_idx'        => ':DELETE',
        '_ns'         => '',
        '_code'       => 'DELETE',
        'label'       => 'Delete',
        'description' => 'Can delete.',
      ),
      array(
        '_idx'        => ':PUBLISH',
        '_ns'         => '',
        '_code'       => 'PUBLISH',
        'label'       => 'Publish',
        'description' => 'Can publish.',
      ),
      array(
        '_idx'        => ':UNPUBLISH',
        '_ns'         => '',
        '_code'       => 'UNPUBLISH',
        'label'       => 'Unpublish',
        'description' => 'Can unpublish.',
      )
    );
    
    foreach($initEntity as $entity){
      $this->createEntity($manager, $entity);
    }
  }
  
  /**
   * {@inheritDoc}
   */
  public function createEntity(ObjectManager $manager, $entity)
  {    
    $attr = new Term();
    foreach($entity as $field=>$value){
      $attr->setIdx($value);
      $attr->setNs($value);
      $attr->setCode($value);
      $attr->setLabel($value);
      $attr->setDescription($value);
    }

    $manager->persist($attr);
    $manager->flush();
  }
}