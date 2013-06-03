<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseStatusManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponsePagingManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestManager;
//use Symfony\Component\Security\Core\SecurityContext;
//use Bioversity\ServerConnectionBundle\Repository\Tags;
//use Bioversity\ServerConnectionBundle\Repository\Types;
//use Bioversity\ServerConnectionBundle\Repository\Operators;
//use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;
//use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
//use Bioversity\TraitBundle\Repository\TraitConnection;

class ServerResponseManager
{
    protected $status;
    protected $request;
    protected $paging;
    protected $response;
    
    
    public function __construct($serverResponse)
    {
        $this->status  = $serverResponse[':WS:STATUS'];
        $this->request = $serverResponse[':WS:REQUEST'];
        $this->paging  = $serverResponse[':WS:PAGING'];
        $this->response= array_key_exists(':WS:RESPONSE',$serverResponse)? $serverResponse[':WS:RESPONSE']: null;
    }
    
    public function getResponse()
    {
        $serverResponseResponseManager= new ServerResponseResponseManager($this->response);
        
        return $serverResponseResponseManager;
    }
    
    public function getRequest()
    {
        $serverResponseRequestManager= new ServerResponseRequestManager($this->request);
        
        return $serverResponseRequestManager/*->getRequest()*/;
    }
    
    public function getPaging()
    {
        $serverResponsePagingManager= new ServerResponsePagingManager($this->paging);
        
        return $serverResponsePagingManager/*->getPaging()*/;
    }
    
    public function getStatus()
    {
        $serverResponseStatusManager= new ServerResponseStatusManager($this->status);
        
        return $serverResponseStatusManager/*->getStatus()*/;
    }
    
}