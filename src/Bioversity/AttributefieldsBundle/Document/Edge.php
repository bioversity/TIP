<?php

namespace Bioversity\AttributefieldsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Edge
{

  /**
   * @MongoDB\Id
   */
  protected $id;
  
  /**
   * @MongoDB\Int
   */
  protected $_subject;
  
  /**
   * @MongoDB\String
   */
  protected $_predicate;
  
  /**
   * @MongoDB\Int
   */
  protected $_object;

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
   * Set _subject
   *
   * @param int $subject
   * @return Edge
   */
  public function setSubject($subject)
  {
      $this->_subject = $subject;
      return $this;
  }

  /**
   * Get _subject
   *
   * @return int $subject
   */
  public function getSubject()
  {
      return $this->_subject;
  }

  /**
   * Set _predicate
   *
   * @param string $predicate
   * @return Edge
   */
  public function setPredicate($predicate)
  {
      $this->_predicate = $predicate;
      return $this;
  }

  /**
   * Get _predicate
   *
   * @return string $predicate
   */
  public function getPredicate()
  {
      return $this->_predicate;
  }

  /**
   * Set _object
   *
   * @param int $object
   * @return Edge
   */
  public function setObject($object)
  {
      $this->_object = $object;
      return $this;
  }

  /**
   * Get _object
   *
   * @return int $object
   */
  public function getObject()
  {
      return $this->_object;
  }
}
