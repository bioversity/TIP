<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class HttpServerConnection
{
  var $db= 'USERS';
  var $secondDB= null;
  var $collection= 'CUser';
  var $domain= "TIP";
  var $operator= '$AND';
  var $distinct= null;
  //var $wrapper= "http://192.168.181.11/TIP/Wrapper.php";
  var $wrapper= "http://temp.wrapper.grinfo.net/TIP/Wrapper.php";
  
  const page_record= 10;
  const logger= 1;
  
  public function setDatabase($db)
  {
    $this->db= $db;
  }
  
  public function setCollection($collection)
  {
    $this->collection= $collection;
  }
  
  public function setOperator($operator)
  {
    $this->operator= $operator;
  }
  
  public function setSecondDB($db)
  {
    $this->secondDB= $db;
  }
  
  public function setDistinct($distinct)
  {
    $this->distinct= $distinct;
  }
  
  /**
   * Create the Request for the WebServer request
   * 
   * @param string $operation
   * @param string $username
   * @param bool $query
   *  
   * @return array $request
   */
  public function createRequest($operation, $query1= NULL, $query2= NULL, $class= NULL)
  {
    $request= $this->buildQuery($this->db, $operation, $query1, $query2, $class);
   
    return $request;
  }
  
  /**
   * Create the Request for the WebServer request
   * 
   * @param string $operation
   * @param array $query
   * @param string $class
   *  
   * @return array $request
   */
  public function createNewRequest($operation, $query= NULL, $class= NULL, $page= 0)
  {
    $request= $this->buildNewQuery($this->db, $operation, $query, $class, $page);
   
    return $request;
  }
  
  /**
   * Create the Request for the WebServer request
   * 
   * @param string $operation
   * @param string $username
   * @param bool $query
   *  
   * @return array $request
   */
  public function createRequestWithMultipleQuery($operation, $query1= NULL, $query2= NULL, $class= NULL)
  {
    $request= $this->buildMultipleQuery($this->db, $operation, $query1, $query2, $class);
   
    return $request;
  }
    
  /*
   * Create the query array for the request
   *
   * @param string $subject
   * @param string $type
   * @param string $data
   *
   * @return array $query
   */
  public function createQuery($subject, $type=':TEXT', $data, $operator = '$EQ')
  {
    return $query= Array(
      '_query-subject'=>$subject,
      '_query-operator'=>$operator,
      '_query-data-type'=>$type,
      '_query-data' => $data
    );
  }
    
  /*
   * Create the query array for the request
   *
   * @param string $subject
   * @param string $type
   * @param string $data
   *
   * @return array $query
   */
  public function createNewQuery($subject, $type=null, $data=null, $operator = '$EQ')
  {
    if(is_array($data))
      $operator= Operators::kOPERATOR_IN;
      
    if($subject == Tags::kTAG_LABEL){
      $subject= $subject.'.'.key($data);
      $data= $data[key($data)];
      $operator= Operators::kOPERATOR_CONTAINS_NOCASE;
    }
    
    if(
      $subject == Tags::kTAG_KIND ||
      $subject == Tags::kTAG_TYPE ||
      $subject == Tags::kTAG_SYNONYMS ||
      $subject == Tags::kTAG_CATEGORY
      ){
      $operator= Operators::kOPERATOR_IN;
    }
    
    $query= Array(
      '_query-subject'=>$subject,
      '_query-operator'=>$operator
    );
    
    if($type)
    $query['_query-data-type']= $type;
    
    if($data !== null)
      $query['_query-data']= $data;
    
    
    
    return $query;
  }
  
  /**
   * Builds and send the Query for the WebServer request
   *
   * @param string $db
   * @param string $operation
   * @param string $username
   * @param array $query
   * @param string $class
   * @param bool $log
   *
   * @return array $request
   *
   */
  public function buildQuery($db, $operation, $query1= NULL, $query2= NULL, $class= NULL, $log= self::logger)
  {
    $request= array(
                ':WS:OPERATION='.$operation,
                ':WS:FORMAT=:JSON',
                ':WS:DATABASE='.urlencode(json_encode($db))
            );
    
    if($class)
      $request[]= ':WS:CLASS='.urlencode(json_encode($class));
    
    if($this->collection)
      $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
    
    
    //if($query1 === NULL){
      if($query2 === NULL)
          $request[]=':WS:QUERY='.urlencode(json_encode(Array('$AND' => Array($query1))));
      else
          $request[]=':WS:QUERY='.urlencode(json_encode(Array('$AND' => Array($query1,$query2))));
    //}
      
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
      
      
    if($this->distinct)
      $request[]= ':WS:DISTINCT='.urlencode(json_encode($this->distinct));
    
    return $request;
  }
  
  /**
   * Builds and send the Query for the WebServer request
   *
   * @param string $db
   * @param string $operation
   * @param string $username
   * @param array $query
   * @param string $class
   * @param bool $log
   *
   * @return array $request
   *
   */
  public function buildNewQuery($db, $operation, $query= NULL, $class= NULL, $pageStart= NULL, $pageLimit= self::page_record, $log= self::logger)
  {
    $request= array(
                ':WS:OPERATION='.$operation,
                ':WS:FORMAT=:JSON',
                ':WS:DATABASE='.urlencode(json_encode($db))
            );
    
    if($this->secondDB)
      $request[]= ':WS:DATABASE-BIS='.urlencode(json_encode($this->secondDB));
    
    if($class)
      $request[]= ':WS:CLASS='.urlencode(json_encode($class));
    
    if($this->collection)
      $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
    
    if($query)
      $request[]=':WS:QUERY='.urlencode(json_encode(Array($this->operator => $query)));
      
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
    
    if($pageStart !== NULL){
      
      if($pageStart > 1 )
        $pageStart= (self::page_record*($pageStart-1))+1;
      $request[]=':WS:PAGE-START='. urlencode(json_encode($pageStart)) ;
    }
    
    if($this->distinct)
      $request[]= ':WS:DISTINCT='.urlencode(json_encode($this->distinct));
    
    if($pageLimit !== NULL)
      $request[]=':WS:PAGE-LIMIT='. urlencode(json_encode($pageLimit)) ;
    
    //return $this->showUnformattedRequest($db, $operation, $query, $class, $log);
    
    return $request;
  }
  
  /**
   * Builds and send the Query for the WebServer request
   *
   * @param string $db
   * @param string $operation
   * @param string $username
   * @param array $query
   * @param string $class
   * @param bool $log
   *
   * @return array $request
   *
   */
  public function buildMultipleQuery($db, $operation, $query1= NULL, $query2= NULL, $class= NULL, $log= self::logger)
  {
    $request= array(
                ':WS:OPERATION='.$operation,
                ':WS:FORMAT=:JSON',
                ':WS:DATABASE='.urlencode(json_encode($db))
            );
    
    if($class)
      $request[]= ':WS:CLASS='.urlencode(json_encode($class));
    
    if($this->collection)
      $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
    
    if($query2 === NULL)
        $request[]=':WS:QUERY='.urlencode(json_encode(Array('$AND' => Array($query1))));
    else
        $request[]=':WS:QUERY='.urlencode(json_encode(Array(
          Array('$AND' => Array($query1)),
          Array('$AND' => Array($query2))
          )
        ));
      
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
    
    return $request;
  }
  
  public function sendRequest($server, $request)
  {
    //var_dump($server.'?'.implode( '&', $request ));die();
    //print_r($server.'?'.implode( '&', $request ));
    return json_decode(file_get_contents( $server.'?'.implode( '&', $request ) ), true);
  }
  
  
  /**
   * This is a debug method
   *
   *
   */
  private function showUnformattedRequest($db, $operation, $query= NULL, $class= NULL, $log= self::logger)
  {
    $request[':WS:OPERATION']=$operation;
    $request[':WS:FORMAT']=':JSON';
    $request[':WS:DATABASE']=$db;
    
    if($class)
      $request[':WS:CLASS']= $class;
    
    if($this->collection)
      $request[':WS:CONTAINER']=$this->collection;
    
    $request[':WS:QUERY']=Array('$AND' => $query);
      
    if($log)
      $request[':WS:LOG-REQUEST']=$log;
    
    return print_r($request);
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  /**
   * Create the Request for the WebServer request
   * 
   * @param string $operation
   * @param array $query
   * @param string $class
   *  
   * @return array $request
   */
  public function createFuckingBastardDuplicatedRequest($operation, $or= NULL, $and= NULL, $class= NULL, $page)
  {
    $request= $this->buildFuckingBastardDuplicatedQuery($this->db, $operation, $or, $and, $class, $page);
   
    return $request;
  }
  
  /**
   * Builds and send the Query for the WebServer request
   *
   * @param string $db
   * @param string $operation
   * @param string $username
   * @param array $query
   * @param string $class
   * @param bool $log
   *
   * @return array $request
   *
   */
  public function buildFuckingBastardDuplicatedQuery(
    $db,
    $operation,
    $or= NULL,
    $and= NULL,
    $class= NULL,
    $pageStart= NULL,
    $pageLimit= self::page_record,
    $log= self::logger)
  {
    $request= array(
                ':WS:OPERATION='.$operation,
                ':WS:FORMAT=:JSON',
                ':WS:DATABASE='.urlencode(json_encode($db))
            );
    
    if($this->secondDB)
      $request[]= ':WS:DATABASE-BIS='.urlencode(json_encode($this->secondDB));      
      
    if($this->distinct)
      $request[]= ':WS:DISTINCT='.urlencode(json_encode($this->distinct));
    
    if($class !== NULL)
      $request[]= ':WS:CLASS='.urlencode(json_encode($class));
    
    if($this->collection)
      $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
        
    if($and !== NULL && $or !== NULL)
      $request[]=':WS:QUERY='.urlencode(json_encode(Array('$AND' => $and, '$OR' => $or)));
    elseif($or !== NULL && $and === NULL)
      $request[]=':WS:QUERY='.urlencode(json_encode(Array('$OR' => $or)));
    elseif($and !== NULL && $or === NULL)
      $request[]=':WS:QUERY='.urlencode(json_encode(Array('$AND' => $and)));
      
    if($log)
      $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($log));
    
    if($pageStart !== NULL){
      
      if($pageStart > 1 )
        $pageStart= (self::page_record*($pageStart-1))+1;
      $request[]=':WS:PAGE-START='. urlencode(json_encode($pageStart)) ;
    }
    
    if($pageLimit !== NULL)
      $request[]=':WS:PAGE-LIMIT='. urlencode(json_encode($pageLimit)) ;
    
    //return $this->showUnformattedRequest($db, $operation, $or, $class, $log);
  
    return $request;
  }
}