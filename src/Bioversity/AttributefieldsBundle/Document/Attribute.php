<?php

/**
 * questa classe è stata gestita creando un'eccezzione nella classe
 *
 * Doctrine\ODM\MongoDB\Persisters\PersistenceBuilder::prepareInsertData* 
 *
 **/
namespace Bioversity\AttributefieldsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Attribute
{

  /**
   * @MongoDB\Id
   */
  protected $id;
  

  /**
   * Get id
   *
   * @return id $id
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Set custom_field
   *
   * @param string $field
   * @param string $value
   * @return Attribute
   */
  public function setCustomField($field, $value)
  {
      $this->$field = $value;
      return $this;
  }
  
}
