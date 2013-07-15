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
    protected $serverResponse;
    
    
    public function __construct($serverResponse)
    {
        $this->serverResponse= $serverResponse;
        $this->status  = array_key_exists(':WS:STATUS',$serverResponse)? $serverResponse[':WS:STATUS']: null;
        $this->request = array_key_exists(':WS:REQUEST',$serverResponse)? $serverResponse[':WS:REQUEST']: null;
        $this->paging  = array_key_exists(':WS:PAGING',$serverResponse)? $serverResponse[':WS:PAGING']: null;
        $this->response= array_key_exists(':WS:RESPONSE',$serverResponse)? $serverResponse[':WS:RESPONSE']: null;
    }
    
    public function getServerResponse()
    {
        return $this->serverResponse;
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
    
    public function setResponse($response)
    {
        $this->response= $response;
    }
    
    public function setRequest($request)
    {
        $this->request= $request;
    }
    
    public function setPaging($paging)
    {
        $this->paging= $paging;
    }
    
    public function setStatus($status)
    {
        $this->status= $status;
    }
    
}