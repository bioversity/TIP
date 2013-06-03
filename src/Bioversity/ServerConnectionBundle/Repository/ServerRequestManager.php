<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestQueryManager;

class ServerRequestManager
{
    protected $wrapper= "http://temp.wrapper.grinfo.net/TIP/Wrapper.php";
    
    protected $format;
    protected $operation;
    protected $operator= '$AND';
    protected $database;
    protected $secondDatabase;
    protected $container;
    protected $pageLimit;
    protected $query= array();
    protected $select;
    protected $collection;
    protected $subDocument;
    protected $log= 1;
    protected $pageStart= 0;
    protected $distinct;
    protected $pageRecord;
    protected $wsclass;
    
    public function sendRequest()
    {
        return new ServerResponseManager(json_decode(file_get_contents( $this->wrapper.'?'.implode( '&', $this->getRequest() ) ), true));
        //return json_decode(file_get_contents( $this->wrapper.'?'.implode( '&', $this->getRequest() ) ), true);
    }
    
    public function getRequest()
    {
        $request= array(
                    ':WS:OPERATION='.$this->operation,
                    ':WS:FORMAT=:JSON',
                    ':WS:DATABASE='.urlencode(json_encode($this->database))
                );
        
        if($this->secondDatabase)
          $request[]= ':WS:DATABASE-BIS='.urlencode(json_encode($this->secondDatabase));
        
        if($this->wsclass)
          $request[]= ':WS:CLASS='.urlencode(json_encode($this->wsclass));
        
        if($this->collection)
          $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
        
        if($this->subDocument)
          $request[]=':WS:SUB-DOCUMENT='.urlencode(json_encode($this->subDocument));
        
        if($this->query){
            $queryList= array();
            foreach($this->query as $query){
                $queryList[]= Array($this->operator => $query);
            }
            $request[]=':WS:QUERY='.urlencode(json_encode($queryList));
        }
        
        if($this->log)
          $request[]=':WS:LOG-REQUEST='.urlencode(json_encode($this->log));
        
        if($this->pageStart !== NULL){          
          if($this->pageStart > 1 )
            $this->pageStart= (self::page_record*($this->pageStart-1))+1;
          $request[]=':WS:PAGE-START='. urlencode(json_encode($this->pageStart)) ;
        }
        
        if($this->distinct)
          $request[]= ':WS:DISTINCT='.urlencode(json_encode($this->distinct));
        
        if($this->pageLimit !== NULL)
          $request[]=':WS:PAGE-LIMIT='. urlencode(json_encode($this->pageLimit)) ;
        
        //return $this->showUnformattedRequest($db, $operation, $query, $class, $log);
        
        return $request;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format=$format;
    }
    
    public function getOperation()
    {
        return $this->operation;
    }
    
    public function setOperation($operation)
    {
        $this->operation=$operation;
    }
    
    public function getOperator()
    {
        return $this->operator;
    }
    
    public function setOperator($operator)
    {
        $this->operator=$operator;
    }
    
    public function getDatabase()
    {
        return $this->database;
    }
    
    public function setDatabase($database)
    {
        $this->database=$database;
    }
    
    public function getSecondDatabase()
    {
        return $this->secondDatabase;
    }
    
    public function setSecondDatabase($secondDatabase)
    {
        $this->secondDatabase=$secondDatabase;
    }
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function setContainer($container)
    {
        $this->container=$container;
    }
    
    public function getPageLimit()
    {
        return $this->pageLimit;
    }
    
    public function setPageLimit($pageLimit)
    {
        $this->pageLimit=$pageLimit;
    }
    
    public function getPageStart()
    {
        return $this->pageStart;
    }
    
    public function setPageStart($pageStart)
    {
        $this->pageStart=$pageStart;
    }
    
    public function getSelect()
    {
        return $this->select;
    }
    
    public function setSelect($select)
    {
        $this->select=$select;
    }
    
    public function getCollection()
    {
        return $this->collection;
    }
    
    public function setCollection($collection)
    {
        $this->collection=$collection;
    }
    
    public function getSubDocument()
    {
        return $this->subDocument;
    }
    
    public function setSubDocument($subDocument)
    {
        $this->subDocument=$subDocument;
    }
    
    public function getLog()
    {
        return $this->log;
    }
    
    public function setLog($log= 1)
    {
        $this->log=$log;
    }
    
    public function getDistinct()
    {
        return $this->distinct;
    }
    
    public function setDistinct($distinct)
    {
        $this->distinct=$distinct;
    }
    
    public function getPageRecord()
    {
        return $this->pageRecord;
    }
    
    public function setPageRecord($record= 10)
    {
        $this->pageRecord=$record;
    }
    
    public function getQuery()
    {
        return $this->query;
    }
    
    public function setQuery($querySubject, $queryDataType, $queryData, $queryOperator)
    {
        $serverQueryManager= new ServerQueryManager();
        $serverQueryManager->setQuery($querySubject, $queryDataType, $queryData, $queryOperator);
        
        $this->query[]= array($serverQueryManager->getQuery());
    }
    
    public function addQuery($querySubject, $queryDataType, $queryData, $queryOperator)
    {
        $serverQueryManager= new ServerQueryManager();
        $serverQueryManager->setQuery($querySubject, $queryDataType, $queryData, $queryOperator);
        
        $this->query[count($this->query)-1][]= $serverQueryManager->getQuery();
    }
}