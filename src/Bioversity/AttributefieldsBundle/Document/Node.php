<?php

namespace Bioversity\AttributefieldsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Node
{

  /**
   * @MongoDB\Id
   */
  protected $id;
  
  /**
   * @MongoDB\String
   */
  protected $_term;
  
  /**
   * @MongoDB\String
   */
  protected $_kind;
  
  /**
   * @MongoDB\String
   */
  protected $_type;

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
   * Get id
   *
   * @return id $id
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Set _term
   *
   * @param string $term
   * @return Node
   */
  public function setTerm($term)
  {
      $this->_term = $term;
      return $this;
  }

  /**
   * Get _term
   *
   * @return string $term
   */
  public function getTerm()
  {
      return $this->_term;
  }

  /**
   * Set _kind
   *
   * @param string $kind
   * @return Node
   */
  public function setKind($kind)
  {
      $this->_kind = $kind;
      return $this;
  }

  /**
   * Get _kind
   *
   * @return string $kind
   */
  public function getKind()
  {
      return $this->_kind;
  }

  /**
   * Set _type
   *
   * @param string $type
   * @return Node
   */
  public function setType($type)
  {
      $this->_type = $type;
      return $this;
  }

  /**
   * Get _type
   *
   * @return string $type
   */
  public function getType()
  {
      return $this->_type;
  }
}
