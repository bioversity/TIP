<?php

namespace Bioversity\SliderBundle\Repository;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class ServerConnection
{
  private $database;
  var $page_record= 25;
  
  public function getNodes($data, $page= 0)
  {
    $requestManager= new ServerRequestManager();;
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_nodes');
    foreach($data as $key=>$value){
      $requestManager->setQuery($key, Types::kTYPE_STRING, $value, Operators::kOPERATOR_EQUAL);
    }
    
    return $requestManager->sendRequest();
  }
  
  public function getRootNodes()
  { 
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setPageLimit(50);
    $requestManager->setSelect(Array(Tags::kTAG_GID,Tags::kTAG_LABEL,Tags::kTAG_DEFINITION,Tags::kTAG_DESCRIPTION,Tags::kTAG_KIND,Tags::kTAG_TYPE));
    $requestManager->setQuery(Tags::kTAG_KIND, Types::kTYPE_STRING, ':KIND-ROOT', Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  public function getNodeDetails($nodeId)
  { 
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT32, $nodeId, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  
  public function getNodeRelationIN($nodeId, $page=NULL)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setPageStart($page);
    $requestManager->setPageLimit($this->page_record);
    $requestManager->setRelation(Types::kTYPE_RELATION_IN);
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT32, $nodeId, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  public function getNodeRelationOUT($nodeId, $page=NULL)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setPageStart($page);
    $requestManager->setPageLimit($this->page_record);
    $requestManager->setRelation(Types::kTYPE_RELATION_OUT);
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT32, $nodeId, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  public function searchNodeRelationIN($nodeId, $term=NULL)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setPageLimit($this->page_record);
    $requestManager->setRelation(Types::kTYPE_RELATION_IN);
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT32, $nodeId, Operators::kOPERATOR_EQUAL);
    $requestManager->setSubQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $term, Operators::kOPERATOR_CONTAINS_NOCASE);
    
    return $requestManager->sendRequest();
  }
  
  public function searchNodeRelationOUT($nodeId, $term=NULL)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetVertex');
    $requestManager->setCollection(':_nodes');
    $requestManager->setPageLimit($this->page_record);
    $requestManager->setRelation(Types::kTYPE_RELATION_OUT);
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT32, $nodeId, Operators::kOPERATOR_EQUAL);
    $requestManager->setSubQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $term, Operators::kOPERATOR_CONTAINS_NOCASE);
    
    return $requestManager->sendRequest();
  }
}