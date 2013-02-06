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
   * Returns the term requested
   *  
   * @return array $serverResponce
   */
  public function getTerm($code, $namespace=NULL)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query1= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $code, Operators::kOPERATOR_EQUAL);
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
  public function saveNew($object, $metod)
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
    
    $query= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GET', $query);
    
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
        $list[]=array('GID'=>$term[Tags::kTAG_GID],'LID'=>$term[Tags::kTAG_LID]);
      }
    }
    
    return $list;
  }
}