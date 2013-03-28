<?php

namespace Bioversity\TraitBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class TraitConnection extends HttpServerConnection
{  
  
  /**
   * Returns the TRAIT requested
   * @param string $gid
   *  
   * @return array $serverResponce
   */
  public function getTrait($gid)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    $query= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:GET', $query);
    
    return $this->sendRequest($this->wrapper, $params);
  }   
  
  /**
   * Returns the TAGS list requested
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query1= $this->createNewQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    $query2= $this->createNewQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    $params= $this->createNewRequest('WS:OP:GetTag', array($query1,$query2),NULL,0);
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the DATA list requested
   * @param string $tags
   * @param string $location
   * @param int $page
   *  
   * @return array $serverResponce
   */
  public function getData($tags, $location=null, $page=0)
  {
    $firstElement= ($page > 1) ? ($page*self::page_record)+1 : 0;
    
    $this->setDatabase('PGRSECURE');
    $this->setSecondDB('ONTOLOGY');
    $this->setCollection(':_units');
    $this->setOperator('$OR');
    foreach($tags as $key=>$tag)
      $or[]= $this->createNewQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
      
    $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GetAnnotated', $or, null, NULL,$firstElement);
    
    if($location){
      $and= array();
      $server= new ServerConnection();
      $term= $server->getTerm('MCPD:ORIGCTY');
      $tag= $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_FEATURES][0];
      $and[]= $this->createNewQuery($tag, Types::kTYPE_STRING, $location, Operators::kOPERATOR_EQUAL);
      $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GetAnnotated', $or, $and, NULL,$firstElement);
    }
    
    return $this->sendRequest($this->wrapper, $params);
  }
}