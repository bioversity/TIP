<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;
use Bioversity\ServerConnectionBundle\Repository\ServerQueryManager;

class ServerResponseRequestManager
{
    protected $format;
    protected $operation;
    protected $database;
    protected $container;
    protected $pageLimit;
    protected $query;
    protected $select;
    protected $pagestart;
    
    
    public function __construct($serverResponseRequest)
    {
        $this->format    = $serverResponseRequest[':WS:FORMAT'];
        $this->operation = $serverResponseRequest[':WS:OPERATION'];
        $this->database  = $serverResponseRequest[':WS:DATABASE'];
        $this->container = $serverResponseRequest[':WS:CONTAINER'];
        $this->pageLimit = $serverResponseRequest[':WS:PAGE-LIMIT'];
        $this->query     = $serverResponseRequest[':WS:QUERY'];
        $this->pagestart = array_key_exists(':WS:PAGE-START',$serverResponseRequest)? $serverResponseRequest[':WS:PAGE-START']: null;
        $this->select    = array_key_exists(':WS:SELECT',$serverResponseRequest)? $serverResponseRequest[':WS:SELECT']: null;
    }
    
    public function getPageStart()
    {
        return $this->pagestart;
    }
    
    public function getFormat()
    {
        return $this->format;
    }
    
    public function getOperation()
    {
        return $this->operation;
    }
    
    public function getDatabase()
    {
        return $this->database;
    }
    
    public function getContainer()
    {
        return $this->container;
    }
    
    public function getPageLimit()
    {
        return $this->pageLimit;
    }
    
    public function getQuery()
    {
        $serverResponseRequestQueryManager= new ServerQueryManager($this->query);
        
        return $serverResponseRequestQueryManager;
    }
    
    public function getSelect()
    {
        return $this->select;
    }
}
