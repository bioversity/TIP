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
class Tag
{

  /**
   * @MongoDB\Id
   */
  protected $id;

  /**
   * @MongoDB\String
   */
  protected $idx;

  /**
   * @MongoDB\Hash
   */
  protected $path;

  /**
   * @MongoDB\String
   */
  protected $type;

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
   * Set id
   *
   * @return Tag
   */
  public function setId($id)
  {
      $this->id = $id;
      return $this;
  }

  /**
   * Set idx
   *
   * @param string $idx
   * @return Tag
   */
  public function setIdx($idx)
  {
      $this->idx = $idx;
      return $this;
  }

  /**
   * Get idx
   *
   * @return string $idx
   */
  public function getIdx()
  {
      return $this->idx;
  }

  /**
   * Set path
   *
   * @param hash $path
   * @return Tag
   */
  public function setPath($path)
  {
      $this->path = $path;
      return $this;
  }

  /**
   * Get path
   *
   * @return hash $path
   */
  public function getPath()
  {
      return $this->path;
  }

  /**
   * Set type
   *
   * @param string $type
   * @return Tag
   */
  public function setType($type)
  {
      $this->type = $type;
      return $this;
  }

  /**
   * Get type
   *
   * @return string $type
   */
  public function getType()
  {
      return $this->type;
  }
}
