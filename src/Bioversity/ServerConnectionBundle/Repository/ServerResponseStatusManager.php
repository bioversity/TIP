<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class ServerResponseStatusManager
{
    protected $statusLevel;
    protected $statusCode;
    protected $affectedCount;
    
    
    public function __construct($serverResponseStatus)
    {
        $this->statusLevel   = $serverResponseStatus[':STATUS-LEVEL'];
        $this->statusCode    = $serverResponseStatus[':STATUS-CODE'];
        $this->affectedCount = $serverResponseStatus[':WS:AFFECTED-COUNT'];
    }
    
    public function getStatusLevel()
    {
        return $this->statusLevel;
    }
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }
    
    public function getAffectedCount()
    {
        return $this->affectedCount;
    }
}
