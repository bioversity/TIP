<?php

namespace Bioversity\OntologyBundle\Repository;

define('Ontology_WS', "http://wrappers.grinfo.net/TIP/Wrapper.php");

require_once('Tags.php');

class ServerConnection
{
  public function buildQuery($db, $log=null)
  {
    $request= array(
            ':WS:OPERATION=WS:OP:GetVertex',
            ':WS:FORMAT=:JSON',
            ':WS:DATABASE='.urlencode(json_encode($db)));
    
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
    
    return $request;
  }
  
  public function getRootNodes()
  { 
    $query= array('subject'=>kTAG_KIND, 'operator'=>'$EQ', 'type'=>':TEXT');
    $select= Array(kTAG_GID,kTAG_LABEL,kTAG_DEFINITION,kTAG_DESCRIPTION,kTAG_KIND,kTAG_TYPE);
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
    return $this->getNodeQuery($nodeId, $query, NULL, $page, 'WS:RELATION:IN', 5);
  }
  
  public function getNodeRelationOUT($nodeId, $page=NULL)
  {
    $query= array('subject'=>'_id', 'operator'=>'$EQ', 'type'=>':INT32');
    return $this->getNodeQuery($nodeId, $query, NULL, $page, 'WS:RELATION:OUT', 5);
  }
  
  public function getNodeQuery($nodeId, $query, $select= NULL, $page= NULL, $relation= NULL, $limit= NULL)
  {
    $request= $this->buildQuery("ONTOLOGY", 1);
    
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
      
    if($limit !== NULL)
      $request[]= ':WS:PAGE-LIMIT='.urlencode(json_encode($limit));
    
    if($relation !== NULL)
      $request[]= ':WS:RELATION='.urlencode(json_encode($relation));
    
    if($page !== NULL)
      $request[]=':WS:PAGE-START='. urlencode(json_encode($page-1)) ;
    
    //return var_dump(Ontology_WS.'?'.implode( '&', $request ));
    return file_get_contents( Ontology_WS.'?'.implode( '&', $request ));
  }
}