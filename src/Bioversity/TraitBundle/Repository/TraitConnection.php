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
   * Returns the TRAIT list requested
   * @param string $word
   *  
   * @return array $serverResponce
   */
  public function getTraits($word)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_tags');
    $query1= $this->createQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $word, Operators::kOPERATOR_CONTAINS_NOCASE);
    $query2= $this->createNewQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    $params= $this->createNewRequest('WS:OP:GetTag', array($query1,$query2),NULL,0);
    
    return $this->sendRequest($this->wrapper, $params);
  } 
  
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
   * Returns the Location requested
   * @param string $distinct
   * @param string $trait
   *  
   * @return array $serverResponce
   */
  public function getLocations($distinct, $tags)
  {    
    $this->setDatabase('PGRSECURE');
    $this->setSecondDB('ONTOLOGY');
    $this->setCollection(':_units');
    $this->setOperator('$OR');
    $this->setDistinct($distinct);
    foreach($tags as $key=>$tag)
      $or[]= $this->createNewQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
      
    $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GET', $or, null, NULL, 0);
      
    return $this->sendRequest($this->wrapper, $params);
  }   
  
  /**
   * Returns the DATA list requested
   * @param string $tags
   * @param string $location
   * @param int $page
   * @param string $species
   *  
   * @return array $serverResponce
   */
  public function getData($tags, $location=null, $page=0, $species=null)
  {
    $firstElement= ($page > 1) ? ($page*self::page_record)+1 : 0;
    
    $this->setDatabase('PGRSECURE');
    $this->setSecondDB('ONTOLOGY');
    $this->setCollection(':_units');
    $this->setOperator('$OR');
    foreach($tags as $key=>$tag)
      $or[]= $this->createNewQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
      
    $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GetAnnotated', $or, null, NULL,$firstElement);
    
    $and= array();
    
    if($location){
      $server= new ServerConnection();
      $term= $server->getTerm('MCPD:ORIGCTY');
      $tag= $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_FEATURES][0];
      $and[]= $this->createNewQuery($tag, Types::kTYPE_STRING, $location, Operators::kOPERATOR_EQUAL);
      $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GetAnnotated', $or, $and, NULL,$firstElement);
    }
    
    if($species){
      $server= new ServerConnection();
      $term= $server->getTerm('GR:TAXON');
      $tag= $term[':WS:RESPONSE']['_term'][$term[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_FEATURES][0];
      $and[]= $this->createNewQuery($tag, Types::kTYPE_STRING, $species, Operators::kOPERATOR_EQUAL);
      $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GetAnnotated', $or, $and, NULL,$firstElement);
    }
    
    return $this->sendRequest($this->wrapper, $params);
  }   
  
  /**
   * Returns the DATA list requested
   * @param string $tags
   * @param string $location
   * @param int $page
   * @param string $species
   *  
   * @return array $serverResponce
   */
  public function getUnits($tags, $page=0)
  {
    $firstElement= ($page > 1) ? ($page*self::page_record)+1 : 0;
    
    $request= array(
                ':WS:OPERATION=WS:OP:GetAnnotated',
                ':WS:FORMAT=:JSON',
                ':WS:DATABASE='.urlencode(json_encode('PGRSECURE')),
                ':WS:DATABASE-BIS='.urlencode(json_encode('ONTOLOGY')),
                ':WS:CONTAINER='.urlencode(json_encode(':_units')),
                ':WS:LOG-REQUEST='.urlencode(json_encode(1)),
                ':WS:PAGE-LIMIT='. urlencode(json_encode(10))
            );
    
    if($firstElement > 1 )
      $firstElement= (self::page_record*($firstElement-1))+1;
    
    $request[]=':WS:PAGE-START='. urlencode(json_encode($firstElement)) ;
    
    $request[]=':WS:QUERY='.urlencode(json_encode($this->createAND($tags)));
    
    //print_r($this->unformatQuery($tags, $page));
    
    return $this->sendRequest($this->wrapper, $request);
  }
  
  public function createAND($list)
  {
    $and=array();
    foreach($list as $key=>$tag){
      $and['$AND'][]= Array('$OR' => $this->createOR($tag));
      //else{
      //  foreach($tag as $field=>$value){
      //    foreach($value as $k=>$v)
      //      $and['$AND'][]= $this->createNewQuery($field, Types::kTYPE_INT, $v, Operators::kOPERATOR_EQUAL);
      //  }
      //}
    }
    
    $keys= $this->getTagKey($list);
    
    //$and['$AND'][]= $this->createNewQuery(Tags::kTAG_TAGS, Types::kTYPE_INT, $keys, Operators::kOPERATOR_IN);
    
    return $and;
  }
  
  public function createOR($list)
  {
    $or=array();
    $query= array();
    foreach($list as $key=>$value){
      $query[]= $this->createNewQuery(Tags::kTAG_TAGS, Types::kTYPE_INT, $key, Operators::kOPERATOR_EQUAL);
      if($value)
        $query[]= $this->createNewQuery($key, Types::kTYPE_STRING, $value, Operators::kOPERATOR_EQUAL);
      
      $or[]['$AND']= $query;
    }
    return $or;
  }
  
  public function getTagKey($list)
  {
    $keys= array();
    foreach($list as $key=>$value){
      $keys[]= array_values(array_unique(array_keys($value)));
    }
    
    $tagkey= array();
    foreach($keys as $key=>$value){
      if(is_array($value)){
        foreach($value as $val=>$tag){
          if(strpos($tag, '.') === false)
            $tagkey[]= $tag;
        }
      }else{
        $tagkey[]= $value[0];
      }
    }
    
    return $tagkey;
  }
  
  private function unformatQuery($tags, $page=0)
  {
    return  $this->createAND($tags);
  }
}