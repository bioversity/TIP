<?php

namespace Bioversity\OntologyBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
{ 
  
  /**
   * Create new namespace/term
   * 
   */
  public function saveNew($object, $metod, $class=null)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:'.$metod,
      ':WS:DATABASE='.urlencode(json_encode('ONTOLOGY')),
      ':WS:OBJECT='.urlencode(json_encode($object)),
      ':WS:LOG-REQUEST='.urlencode(json_encode(1)),
      //':WS:LOG-TRACE='.urlencode(json_encode(1))
      );
    
    if($class)
      $params[]=':WS:CLASS='.urlencode(json_encode($class));
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Create new nodes Relation
   * @param int $subject
   * @param string $predicate
   * @param int $object
   *  
   * @return array $serverResponce
   */
  public function saveRelation($subject, $predicate, $object)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:RelateTo',
      ':WS:DATABASE='.urlencode(json_encode('ONTOLOGY')),
      ':WS:PREDICATE='.urlencode(json_encode($predicate)),
      ':WS:REL-FROM='.urlencode(json_encode($object)),
      ':WS:REL-TO='.urlencode(json_encode($subject)),
      ':WS:LOG-REQUEST='.urlencode(json_encode(1)),
      ':WS:LOG-TRACE='.urlencode(json_encode(1))
      );
    
    return $this->sendRequest($this->wrapper, $params);
  }
}