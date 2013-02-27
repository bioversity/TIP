<?php

namespace Bioversity\OntologyBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
{
  
  /**
   * Returns the tags language list
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
    
    //if($namespace){
    //  $query2= $this->createQuery(Tags::kTAG_NAMESPACE, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_EQUAL);
    //  $params= $this->createRequest('WS:OP:GetTerm', $query1, $query2);
    //}else{
    //  $params= $this->createRequest('WS:OP:GetTerm', $query1);
    //}
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the term requested
   *  
   * @return array $serverResponce
   */
  public function getLID($code, $namespace=NULL)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    
    if($namespace){
      $query2= $this->createQuery(Tags::kTAG_NAMESPACE, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_EQUAL);
      $params= $this->createRequest('WS:OP:GetTerm', $query1, $query2);
    }else{
      $params= $this->createRequest('WS:OP:GetTerm', $query1);
    }
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the term requested
   * @param string $code
   *  
   * @return array $serverResponce
   */
  public function getTermByCode($code)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $code, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GetTerm', $query);
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  
  /**
   * Returns the Node list requested
   * @param string $nid
   *  
   * @return array $serverResponce
   */
  public function getNodeByNIDTerm($nid)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_TERM, Types::kTYPE_STRING, $nid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GetVertex', $query);
    
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
   * Create new namespace/term
   * 
   */
  public function saveNew($object, $metod, $class=null)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:'.$metod,
      ':WS:DATABASE='.urlencode(json_encode($this->db)),
      ':WS:OBJECT='.urlencode(json_encode($object))
      );
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Create new nodes Relation
   * @param int $subject
   * @param string $predicate
   * @param int $object
   *  
   * @return array $serverResponce
   */
  public function saveRelation($subject, $predicate, $object)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:RelateTo',
      ':WS:DATABASE='.urlencode(json_encode('ONTOLOGY')),
      ':WS:PREDICATE='.urlencode(json_encode($predicate)),
      ':WS:REL-FROM='.urlencode(json_encode($object)),
      ':WS:REL-TO='.urlencode(json_encode($subject)),
      ':WS:LOG-REQUEST='.urlencode(json_encode(1)),
      ':WS:LOG-TRACE='.urlencode(json_encode(1))
      );
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the LID requested
   * @param string $lid
   * @param string $namespace
   * 
   * @return array $serverResponce
   */
  public function findLID($lid, $namespace=NULL)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    
    if($namespace)
      $lid= $namespace.':'.$lid;
    
    //print_r($lid);
    
    $query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    $query2= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    //$query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_EQUAL);
    //$query2= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequestWithMultipleQuery('WS:OP:GET', $query1,$query2);
    
    //print_r($this->sendRequest($this->wrapper, $params));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  /**
   * Returns the LABEL requested
   * @param string $lid
   * @param string $namespace
   * 
   * @return array $serverResponce
   */
  public function findLABEL($label)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    
    $query1= $this->createQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $label, Operators::kOPERATOR_CONTAINS_NOCASE);
    $params= $this->createRequest('WS:OP:GET', $query1);
    
    //print_r($this->sendRequest($this->wrapper, $params));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  
  /**
   * Returns the NAMESPACE requested
   * @param string $namespace
   *  
   * @return array $serverResponce
   */
  public function findNAMESPACE($namespace)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    $query= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_PREFIX);
    $params= $this->createRequest('WS:OP:GET', $query);
    
    //print_r($this->clearResponse($this->sendRequest($this->wrapper, $params)));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  private function clearResponse($response)
  {
    $list= array();
    if($response[':WS:STATUS'][':WS:AFFECTED-COUNT'] >= 1){
      $terms= $response[':WS:RESPONSE'];
      foreach($terms as $term){
        if(array_key_exists(Tags::kTAG_LABEL, $term))
          $list[]=array('GID'=>$term[Tags::kTAG_GID],'LID'=>$term[Tags::kTAG_LID],'LABEL'=>$term[Tags::kTAG_LABEL]['en']);
        else
          $list[]=array('GID'=>$term[Tags::kTAG_GID],'LID'=>$term[Tags::kTAG_LID]);  
      }
    }
    
    return $list;
  }
}