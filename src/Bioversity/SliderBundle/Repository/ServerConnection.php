<?php

namespace Bioversity\SliderBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
{
  var $page_record= 25;
  
  public function getNodes($data, $page){
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_nodes');
    
    $query=Array();
    foreach($data as $key=>$value){
      $query[]= $this->createNewQuery($key, Types::kTYPE_STRING, $value, Operators::kOPERATOR_EQUAL);
    }
    $params= $this->createNewRequest('WS:OP:GET', $query, NULL, $page);
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  public function getRootNodes()
  { 
    $query= array('subject'=>Tags::kTAG_KIND, 'operator'=>'$EQ', 'type'=>':TEXT');
    $select= Array(Tags::kTAG_GID,Tags::kTAG_LABEL,Tags::kTAG_DEFINITION,Tags::kTAG_DESCRIPTION,Tags::kTAG_KIND,Tags::kTAG_TYPE);
    $limit= 50;
    $nodeId= ':KIND-ROOT';
    
    return $this->getNodeQuery($nodeId, $query, $select, NULL, NULL, $limit);
  }
  
  public function getNodeDetails($nodeId)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    return $this->getNodeQuery($nodeId, $query);
  }
  
  
  public function getNodeRelationIN($nodeId, $page=NULL)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    return $this->getNodeQuery($nodeId, $query, NULL, $page, Types::kTYPE_RELATION_IN, $this->page_record);
  }
  
  public function getNodeRelationOUT($nodeId, $page=NULL)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    return $this->getNodeQuery($nodeId, $query, NULL, $page, Types::kTYPE_RELATION_OUT, $this->page_record);
  }
  
  public function searchNodeRelationIN($nodeId, $term=NULL)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    $query2= array('subject'=>Tags::kTAG_LABEL.'.en', 'operator'=>'$CXi', 'type'=>':TEXT', 'data'=>$term);
    return $this->getNodeQuery($nodeId, $query, NULL, NULL, Types::kTYPE_RELATION_IN, $this->page_record, $query2);
  }
  
  public function searchNodeRelationOUT($nodeId, $term=NULL)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    $query2= array('subject'=>Tags::kTAG_LABEL.'.en', 'operator'=>'$CXi', 'type'=>':TEXT', 'data'=>$term);
    return $this->getNodeQuery($nodeId, $query, NULL, $term, Types::kTYPE_RELATION_OUT, $this->page_record, $query2);
  }
  
  public function getNodeQuery(
    $nodeId, $query, $select= NULL,
    $page= 1, $relation= NULL, $limit= NULL,
    $query2= null)
  {
    $request= $this->manageQuery("ONTOLOGY", 1);
    
    if($select !== NULL)
      $request[]= ':WS:SELECT='.urlencode(json_encode($select));
      
    $request[]=':WS:QUERY='.urlencode(json_encode(Array(
                      '$AND' => Array(
                                  Array(
                                    '_query-subject' => $query['subject'],
                                    '_query-operator' => $query['operator'],
                                    '_query-data-type' => $query['type'],
                                    '_query-data' => $nodeId,
                                  )
                                )
                      )));
    
    if($query2)    
      $request[]=':WS:SUBQUERY='.urlencode(json_encode(Array(
                        '$AND' => Array(
                                    Array(
                                      '_query-subject' => $query2['subject'],
                                      '_query-operator' => $query2['operator'],
                                      '_query-data-type' => $query2['type'],
                                      '_query-data' => $query2['data'],
                                    )
                                  )
                        )));
      
    if($limit !== NULL)
      $request[]= ':WS:PAGE-LIMIT='.urlencode(json_encode($limit));
    
    if($relation !== NULL)
      $request[]= ':WS:RELATION='.urlencode(json_encode($relation));
    
    if($page !== NULL){
      if($page > 0 )
        $page= ($this->page_record*($page-1));
      $request[]=':WS:PAGE-START='. urlencode(json_encode($page)) ;
    }
    //return print_r($this->wrapper.'?'.implode( '&', $request ));
    return file_get_contents( $this->wrapper.'?'.implode( '&', $request ));
  }
  
  public function manageQuery($db, $log=null)
  {
    $request= array(
            ':WS:OPERATION=WS:OP:GetVertex',
            ':WS:FORMAT=:JSON',
            ':WS:DATABASE='.urlencode(json_encode($db)));
    
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
    
    return $request;
  }
}