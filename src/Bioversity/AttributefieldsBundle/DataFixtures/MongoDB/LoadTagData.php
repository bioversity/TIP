<?php

namespace Bioversity\AttributefieldsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Bioversity\AttributefieldsBundle\Document\Tag;

class LoadTagData implements FixtureInterface
{
  /**
  * {@inheritDoc}
  */
  public function load(ObjectManager $manager)
  {      
    $initEntity= array(
      array(
        '_id'   => '1',
        '_idx'  => ':LABEL/:STRING',
        '_path' => ':LABEL',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '2',
        '_idx'  => ':DESCRIPTION/:STRING',
        '_path' => ':DESCRIPTION',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '3',
        '_idx'  => ':CODE/:ATTRIBUTE-OF/:USER/:STRING',
        '_path' => ':CODE/:ATTRIBUTE-OF/:USER',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '4',
        '_idx'  => ':PASSWORD/:ATTRIBUTE-OF/:USER/:STRING',
        '_path' => ':PASSWORD/:ATTRIBUTE-OF/:USER',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '5',
        '_idx'  => ':NAME/:ATTRIBUTE-OF/:USER/:STRING',
        '_path' => ':NAME/:ATTRIBUTE-OF/:USER',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '6',
        '_idx'  => ':EMAIL/:ATTRIBUTE-OF/:USER/:STRING',
        '_path' => ':EMAIL/:ATTRIBUTE-OF/:USER',
        '_type' => 'STRING',
      ),
      array(
        '_id'   => '7',
        '_idx'  => ':ROLE/:ATTRIBUTE-OF/:USER/:ENUM',
        '_path' => ':ROLE/:ATTRIBUTE-OF/:USER',
        '_type' => 'ENUM',
      ),
      array(
        '_id'   => '8',
        '_idx'  => ':PERMISSIONS-USER/:ATTRIBUTE-OF/:USER/:SET',
        '_path' => ':PERMISSIONS-USER/:ATTRIBUTE-OF/:USER',
        '_type' => 'SET',
      ),
      array(
        '_id'   => '9',
        '_idx'  => ':PERMISSIONS-PASSPORT/:ATTRIBUTE-OF/:USER/:SET',
        '_path' => ':PERMISSIONS-PASSPORT/:ATTRIBUTE-OF/:USER',
        '_type' => 'SET',
      ),
      array(
        '_id'   => '10',
        '_idx'  => ':PERMISSIONS-DATASET/:ATTRIBUTE-OF/:USER/:SET',
        '_path' => ':PERMISSIONS-DATASET/:ATTRIBUTE-OF/:USER',
        '_type' => 'SET',
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
    $attr = new Tag();
    foreach($entity as $field=>$value){
      $attr->setId($value);
      $attr->setIdx($value);
      $attr->setPath($value);
      $attr->setType($value);
    }
  
    $manager->persist($attr);
    $manager->flush();
  }
}