<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Symfony\Component\HttpFoundation\Session\Session;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
//use Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestQueryManager;


class ServerRequestManager
{
    const page_record= 10;

	//
	// Database and wrapper settings.
	//
	protected $databaseOntology  = 'METADATA';
	protected $databaseUsers     = 'DATA';
	protected $databasePGRSecure = 'DATA';
	//
	// SERVER Wrapper.
	//
	protected $wrapper = 'http://192.168.181.11/PGRDG/MongoWrapper.php';
	//
	// LOCAL Wrapper.
	//
//	protected $wrapper = 'http://localhost/services/Wrappers/PGRDG/MongoWrapper.php';

	protected $format;
    protected $operation;
    protected $operator= '$AND';
    protected $database;
    protected $secondDatabase;
    protected $container;
    protected $pageLimit;
	protected $sort;
    protected $query= array();
    protected $subquery= array();
    protected $select;
    protected $collection;
    protected $subDocument;
    protected $log= 1;
    protected $pageStart= 0;
    protected $distinct;
    protected $pageRecord;
    protected $wsclass;
    protected $relation;
    protected $obj;
    protected $criteria;
    
    public function __construct()
    {
        if(array_key_exists('isTestEnv', $_SESSION['_sf2_attributes']))
        {
            if($_SESSION['_sf2_attributes']['isTestEnv'] == 'test')
            {
                $this->wrapper= "http://temp.wrapper.grinfo.net/TIP/Wrapper.test.php";
                $this->setDatabaseOntology('TEST-'.$this->getDatabaseOntology());
                $this->setDatabasePGRSecure('TEST-'.$this->getDatabasePGRSecure());
                $this->setDatabaseUsers('TEST-'.$this->getDatabaseUsers());
            }
        }
    }
    
    public function setWrapper($url)
    {
        $this->wrapper= $url;
    }
    
    public function getWrapper()
    {
        return $this->wrapper;
    }
    
    public function setDatabaseOntology($name= 'ONTOLOGY')
    {
        $this->databaseOntology= $name;
    }
    
    public function getDatabaseOntology()
    {
        return $this->databaseOntology;
    }
    
    public function setDatabasePGRSecure($name= 'PGRSECURE')
    {
        $this->databasePGRSecure= $name;
    }
    
    public function getDatabasePGRSecure()
    {
        return $this->databasePGRSecure;
    }
    
    public function setDatabaseUsers($name= 'USERS')
    {
        $this->databaseUsers= $name;
    }
    
    public function getDatabaseUsers()
    {
        return $this->databaseUsers;
    }
    
    public function sendRequest()
    {
//print_r($this->wrapper.'?'.implode( '&', $this->getRequest() ) );
//exit;
        return new ServerResponseManager(json_decode(file_get_contents( $this->wrapper.'?'.implode( '&', $this->getRequest() ) ), true));
    }
    
    public function sendUrl($url)
    {
        return new ServerResponseManager(json_decode(file_get_contents($url), true));
    }
    
    public function getRequestUrl()
    {
        return $this->wrapper.'?'.implode( '&', $this->getRequest() );
    }
    
    public function getRequest()
    {
        $request= array(
                    ':WS:OPERATION='.$this->operation,
                    ':WS:FORMAT=:JSON',
                    ':WS:DATABASE='.urlencode(json_encode($this->database))
                );
        
        if($this->relation)
            $request[]= ':WS:RELATION='.urlencode(json_encode($this->relation));
      
        if($this->select)
            $request[]= ':WS:SELECT='.urlencode(json_encode($this->select));
      
        if($this->secondDatabase)
          $request[]= ':WS:DATABASE-BIS='.urlencode(json_encode($this->secondDatabase));
        
        if($this->wsclass)
          $request[]= ':WS:CLASS='.urlencode(json_encode($this->wsclass));
        
        if($this->collection)
          $request[]=':WS:CONTAINER='.urlencode(json_encode($this->collection));
        
        if($this->subDocument)
          $request[]=':WS:SUB-DOCUMENT='.urlencode(json_encode($this->subDocument));
        
        if($this->obj)
            $request[]=':WS:OBJECT='.urlencode(json_encode($this->obj));
            
        if($this->query){
            $queryList= array();
            
            foreach($this->query as $query){
                if($this->operator === null){
                    $queryList= $this->query;
                }else{
                if(count($this->query) > 1)
                    $queryList[]= Array($this->operator => $query);
                else
                    $queryList[$this->operator]=  $query;
                }
            }
                
            $request[]=':WS:QUERY='.urlencode(json_encode($queryList));
        }
        
        if($this->subquery){
            $queryList= array();
            foreach($this->subquery as $query){
                $queryList[]= Array($this->operator => $query);
            }
            $request[]=':WS:SUBQUERY='.urlencode(json_encode($queryList));
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

	    if($this->sort !== NULL)
		    $request[]=':WS:SORT='. urlencode(json_encode($this->sort)) ;

        if($this->criteria)
            $request[]=':WS:CRITERIA='.urlencode(json_encode($this->criteria)) ;
            
        //return $this->showUnformattedRequest($db, $operation, $query, $class, $log);
        
        return $request;
    }

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function setCriteria($criteria)
    {
        $this->criteria= $criteria;
    }

    public function getRelation()
    {
        return $this->relation;
    }

    public function setRelation($relation)
    {
        $this->relation= $relation;
    }

    public function getObject()
    {
        return $this->obj;
    }

    public function setObject($object)
    {
        $this->obj= $object;
    }

    public function getWsClass()
    {
        return $this->wsclass;
    }

    public function setWsClass($wsClass)
    {
        $this->wsclass=$wsClass;
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

	public function getSort()
	{
		return $this->sort;
	}

	public function setPageLimit($pageLimit)
	{
		$this->pageLimit=$pageLimit;
	}

	public function setSort($sort)
	{
		$this->sort=$sort;
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
    
    public function getSubQuery()
    {
        return $this->subquery;
    }
    
    public function setSubQuery($querySubject, $queryDataType, $queryData, $queryOperator)
    {
        $serverQueryManager= new ServerQueryManager();
        $serverQueryManager->setQuery($querySubject, $queryDataType, $queryData, $queryOperator);
        
        $this->subquery[]= array($serverQueryManager->getQuery());
    }
    
    public function addQuery($querySubject, $queryDataType, $queryData, $queryOperator)
    {
        $serverQueryManager= new ServerQueryManager();
        $serverQueryManager->setQuery($querySubject, $queryDataType, $queryData, $queryOperator);
        
        $this->query[count($this->query)-1][]= $serverQueryManager->getQuery();
    }
    
    public function addSubQuery($querySubject, $queryDataType, $queryData, $queryOperator)
    {
        $serverQueryManager= new ServerQueryManager();
        $serverQueryManager->setQuery($querySubject, $queryDataType, $queryData, $queryOperator);
        
        $this->subquery[count($this->subquery)-1][]= $serverQueryManager->getQuery();
    }
    
    public function setCustomQuery($query)
    {
        $this->query= $query;
    }
    
    public function setCustomSubQuery($subquery)
    {
        $this->subquery= $subquery;
    }
}