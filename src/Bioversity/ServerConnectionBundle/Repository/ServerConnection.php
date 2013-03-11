<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
{  
  /**
   * Returns the tags language list
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    $params= $this->createRequest('WS:OP:GetTag', $query);
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the enumeration options
   * @param int $id
   *  
   * @return array $serverResponce
   */
  public function getEnumOptions($id)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_NID, Types::kTYPE_INT, $id, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GetEnums', $query, NULL, 'COntologyTag');
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the term requested
   * @param string $namespace
   *  
   * @return array $serverResponce
   */
  public function getNamespace($namespace)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GetTerm', $query);
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the term requested
   * @param string $code
   * @param string $namespace
   *  
   * @return array $serverResponce
   */
  public function getTerm($code, $namespace=NULL)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    
    $gid= $namespace ? $namespace.':'.$code : $code;
    
    $query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GetTerm', $query1);
  
    return $this->sendRequest($this->wrapper, $params);
  }
  
}