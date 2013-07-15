<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class AutocompleteMethod
{    
  /**
   * Returns the LID requested
   * @param string $lid
   * @param string $namespace
   * 
   * @return array $serverResponce
   */
  public function findLID($lid, $namespace=NULL)
  {
    $lid= $namespace? $namespace.':'.$lid : $lid;
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_terms');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    $requestManager->setQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    
    //print_r($requestManager->sendRequest());
    return $this->clearResponse($requestManager->sendRequest());
  }
  
  /**
   * Returns the LABEL requested
   * @param string $lid
   * @param string $namespace
   * 
   * @return array $serverResponce
   */
  public function findLABEL($label)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_terms');
    $requestManager->setQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $label, Operators::kOPERATOR_CONTAINS_NOCASE);
    
    return $this->clearResponse($requestManager->sendRequest());
  }
  
  
  /**
   * Returns the NAMESPACE requested
   * @param string $namespace
   *  
   * @return array $serverResponce
   */
  public function findNAMESPACE($namespace)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_terms');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_PREFIX);
    
    return $this->clearResponse($requestManager->sendRequest());
  }
  
  /**
   * Returns the GID requested
   * @param string $gid
   * 
   * @return array $serverResponce
   */
  public function findGID($gid)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_nodes');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_CONTAINS_NOCASE);
    
    return $this->clearResponse($requestManager->sendRequest());
  }  
  
  /**
   * Returns the TRAIT requested
   * @param string $term
   *  
   * @return array $serverResponce
   */
  public function findTrait($term)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_terms');
    $requestManager->setQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $term, Operators::kOPERATOR_CONTAINS_NOCASE);
    $requestManager->addQuery(Tags::kTAG_FEATURES, Types::kTYPE_INT, NULL, Operators::kOPERATOR_NOT_NULL);
    
    return $this->clearResponse($requestManager->sendRequest());
  }
  
  /**
   * Returns the Tag detail by label
   * That method return ad atipical response
   * @param string $label
   *  
   * @return array $serverResponce
   */
  public function findTagByLabel($label)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_tags');
    $requestManager->setDistinct(Tags::kTAG_LABEL.'.en');
    $requestManager->setQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $label, Operators::kOPERATOR_CONTAINS_NOCASE);
    $requestManager->addQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    
    $response= $requestManager->sendRequest();
    return  ($response->getResponse())? $response->getResponse()->getAllResponse() : array('no trait found');
  }
  
  public function clearResponse(ServerResponseManager $response)
  {
    $list= array();
    if($response->getStatus()->getAffectedCount() >= 1){
      $terms= $response->getResponse()->getAllResponse();
      foreach($terms as $term){
        if(array_key_exists(Tags::kTAG_LABEL, $term))
          $list[]=array('GID'=>$term[Tags::kTAG_GID],'LID'=>$term[Tags::kTAG_LID],'LABEL'=>$term[Tags::kTAG_LABEL]['en'].' ('.$term[Tags::kTAG_GID].')');
        else
          $list[]=array('GID'=>$term[Tags::kTAG_GID],'LID'=>$term[Tags::kTAG_LID]);  
      }
    }
    
    return $list;
  }
}