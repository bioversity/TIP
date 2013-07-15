<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerQueryManager;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class Nodes
{ 
  
  /**
   * Returns the Node list requested
   * @param string $nid
   *  
   * @return array $serverResponce
   */
  public function getNodeByNIDTerm($nid)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setQuery(Tags::kTAG_TERM, Types::kTYPE_STRING, $nid, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
}