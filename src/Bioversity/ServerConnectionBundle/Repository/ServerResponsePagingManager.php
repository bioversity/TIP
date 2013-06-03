<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class ServerResponsePagingManager
{
    protected $pageStart;
    protected $pageLimit;
    protected $pageCount;
    
    
    public function __construct($serverResponsePaging)
    {
        $this->pageStart = $serverResponsePaging[':WS:PAGE-START'];
        $this->pageLimit = $serverResponsePaging[':WS:PAGE-LIMIT'];
        $this->pageCount = $serverResponsePaging[':WS:PAGE-COUNT'];
    }
    
    public function getPageStart()
    {
        return $this->pageStart;
    }
    
    public function getPageLimit()
    {
        return $this->pageLimit;
    }
    
    public function getPageCount()
    {
        return $this->pageCount;
    }
}
