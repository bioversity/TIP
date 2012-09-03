<?php

namespace Bioversity\AttributefieldsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bioversity\AttributefieldsBundle\Document\Node;

class LoadNodeData implements FixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $initEntity= array(
        array(
          '_id' => '1',
          '_term' => ':USER',
          '_kind' => ':ROOT;:TRAIT',
          '_type' => '',
        ),
        array(
          '_id' => '2',
          '_term' => ':CODE',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':STRING',
        ),
        array(
          '_id' => '3',
          '_term' => ':PASSWORD',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':STRING',
        ),
        array(
          '_id' => '4',
          '_term' => ':NAME',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':STRING',
        ),
        array(
          '_id' => '5',
          '_term' => ':EMAIL',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':STRING',
        ),
        array(
          '_id' => '6',
          '_term' => ':ROLE',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '7',
          '_term' => ':ADMIN',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '8',
          '_term' => ':CATALOGUE-USER',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '9',
          '_term' => ':INVENTORY-USER',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '10',
          '_term' => ':COLLECTION-USER',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '11',
          '_term' => ':GENERIC-USER',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '12',
          '_term' => ':PERMISSIONS-USER',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':SET',
        ),
        array(
          '_id' => '13',
          '_term' => ':CREATE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '14',
          '_term' => ':LIST',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '15',
          '_term' => ':READ',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '16',
          '_term' => ':MODIFY',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '17',
          '_term' => ':DELETE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '18',
          '_term' => ':PERMISSIONS-PASSPORT',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':SET',
        ),
        array(
          '_id' => '19',
          '_term' => ':CREATE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '20',
          '_term' => ':LIST',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '21',
          '_term' => ':READ',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '22',
          '_term' => ':MODIFY',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '23',
          '_term' => ':DELETE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '24',
          '_term' => ':PUBLISH',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '25',
          '_term' => ':UNPUBLISH',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '26',
          '_term' => ':PERMISSIONS-DATASET',
          '_kind' => ':METHOD;:SCALE',
          '_type' => ':SET',
        ),
        array(
          '_id' => '27',
          '_term' => ':CREATE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '28',
          '_term' => ':LIST',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '29',
          '_term' => ':READ',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '30',
          '_term' => ':MODIFY',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '31',
          '_term' => ':DELETE',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '32',
          '_term' => ':PUBLISH',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
        array(
          '_id' => '33',
          '_term' => ':UNPUBLISH',
          '_kind' => ':ENUM',
          '_type' => ':ENUM',
        ),
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
    $attr = new Node();
    foreach($entity as $field=>$value){
      $attr->setId($value);
      $attr->setTerm($value);
      $attr->setKind($value);
      $attr->setType($value);
    }

    $manager->persist($attr);
    $manager->flush();
  }
}