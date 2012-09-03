<?php

namespace Bioversity\AttributefieldsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Term
{

  /**
   * @MongoDB\Id
   */
  protected $id;
  
  /**
   * @MongoDB\String
   */
  protected $_idx;
  
  /**
   * @MongoDB\String
   */
  protected $_ns;
  
  /**
   * @MongoDB\String
   */
  protected $_code;
  
  /**
   * @MongoDB\String
   */
  protected $label;
  
  /**
   * @MongoDB\String
   */
  protected $description;

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
   * Set _idx
   *
   * @param string $idx
   * @return Term
   */
  public function setIdx($idx)
  {
      $this->_idx = $idx;
      return $this;
  }

  /**
   * Get _idx
   *
   * @return string $idx
   */
  public function getIdx()
  {
      return $this->_idx;
  }

  /**
   * Set _ns
   *
   * @param string $ns
   * @return Term
   */
  public function setNs($ns)
  {
      $this->_ns = $ns;
      return $this;
  }

  /**
   * Get _ns
   *
   * @return string $ns
   */
  public function getNs()
  {
      return $this->_ns;
  }

  /**
   * Set _code
   *
   * @param string $code
   * @return Term
   */
  public function setCode($code)
  {
      $this->_code = $code;
      return $this;
  }

  /**
   * Get _code
   *
   * @return string $code
   */
  public function getCode()
  {
      return $this->_code;
  }

  /**
   * Set label
   *
   * @param string $label
   * @return Term
   */
  public function setLabel($label)
  {
      $this->label = $label;
      return $this;
  }

  /**
   * Get label
   *
   * @return string $label
   */
  public function getLabel()
  {
      return $this->label;
  }

  /**
   * Set description
   *
   * @param string $description
   * @return Term
   */
  public function setDescription($description)
  {
      $this->description = $description;
      return $this;
  }

  /**
   * Get description
   *
   * @return string $description
   */
  public function getDescription()
  {
      return $this->description;
  }
}
