<?php

namespace Bioversity\AttributefieldsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bioversity\AttributefieldsBundle\Document\Edge;

class LoadEdgeData implements FixtureInterface
{
  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $initEntity= array(
      array(
        '_subject'   => '2',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '3',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '4',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '5',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '6',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '7',
        '_predicate' => ':ENUM-OF',
        '_object'    => '6',
      ),
      array(
        '_subject'   => '8',
        '_predicate' => ':ENUM-OF',
        '_object'    => '6',
      ),
      array(
        '_subject'   => '9',
        '_predicate' => ':ENUM-OF',
        '_object'    => '6',
      ),
      array(
        '_subject'   => '10',
        '_predicate' => ':ENUM-OF',
        '_object'    => '6',
      ),
      array(
        '_subject'   => '11',
        '_predicate' => ':ENUM-OF',
        '_object'    => '6',
      ),
      array(
        '_subject'   => '12',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '13',
        '_predicate' => ':ENUM-OF',
        '_object'    => '12',
      ),
      array(
        '_subject'   => '14',
        '_predicate' => ':ENUM-OF',
        '_object'    => '12',
      ),
      array(
        '_subject'   => '15',
        '_predicate' => ':ENUM-OF',
        '_object'    => '12',
      ),
      array(
        '_subject'   => '16',
        '_predicate' => ':ENUM-OF',
        '_object'    => '12',
      ),
      array(
        '_subject'   => '17',
        '_predicate' => ':ENUM-OF',
        '_object'    => '12',
      ),
      array(
        '_subject'   => '18',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '19',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '20',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '21',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '22',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '23',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '24',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '25',
        '_predicate' => ':ENUM-OF',
        '_object'    => '18',
      ),
      array(
        '_subject'   => '26',
        '_predicate' => ':ATTRIBUTE-OF',
        '_object'    => '1',
      ),
      array(
        '_subject'   => '27',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '28',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '29',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '30',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '31',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '32',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
      ),
      array(
        '_subject'   => '33',
        '_predicate' => ':ENUM-OF',
        '_object'    => '26',
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
    $attr = new Edge();
    foreach($entity as $field=>$value){
      $attr->setSubject($value);
      $attr->setPredicate($value);
      $attr->setObject($value);
    }

    $manager->persist($attr);
    $manager->flush();
  }
}