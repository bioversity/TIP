<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerQueryManager;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class Terms
{
  /**
   * This method return the server response for requested term
   * @param string $code
   * @param string $namespace
   *
   * @return array $requestManager
   */
  public function getTerm($code, $namespace=NULL)
  {
    $gid= $namespace ? $namespace.':'.$code : $code;
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTerm');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  //TODO
  /**
   * Create new namespace/term
   * 
   */
  public function saveNew($object, $metod)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:SetTerm',
      ':WS:DATABASE='.urlencode(json_encode('ONTOLOGY')),
      ':WS:OBJECT='.urlencode(json_encode($object)),
      ':WS:LOG-REQUEST='.urlencode(json_encode(1)),
      //':WS:LOG-TRACE='.urlencode(json_encode(1))
      );
    
    if($class)
      $params[]=':WS:CLASS='.urlencode(json_encode($class));
    
    return $this->sendRequest($this->wrapper, $params);
  }
}