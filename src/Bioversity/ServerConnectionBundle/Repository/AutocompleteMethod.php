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
    $requestManager->setDatabase('ONTOLOGY');
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
    $requestManager->setDatabase('ONTOLOGY');
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
    $requestManager->setDatabase('ONTOLOGY');
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
    $requestManager->setDatabase('ONTOLOGY');
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
    $requestManager->setDatabase('ONTOLOGY');
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
    $requestManager->setDatabase('ONTOLOGY');
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_tags');
    $requestManager->setDistinct(Tags::kTAG_LABEL.'.en');
    $requestManager->setQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $label, Operators::kOPERATOR_CONTAINS_NOCASE);
    $requestManager->addQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    
    $response= $requestManager->sendRequest();
    return  (array_key_exists(':WS:RESPONSE', $response))? $response[':WS:RESPONSE'] : array('no trait found');
  }
  
  /**
   * Returns the TAXO requested
   * @param string $term
   * @param string $traitValue
   *  
   * @return array $serverResponce
   */
  //public function findTaxo($word, $traitValue)
  //{
  //  //$tagsClass= new Tags();
  //  //$traitConnection= new TraitConnection();
  //  //$trait= $traitConnection->getTrait($traitValue);
  //  //$features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
  //  //$tagsList= $tagsClass->getTagBy($features, Tags::kTAG_NID);
  //  //
  //  //$tags= array();
  //  //foreach($tagsList[':WS:RESPONSE']['_tag'] as $key=>$value){
  //  //    if(count($value[Tags::kTAG_OFFSETS]) > 0){
  //  //        foreach($value[Tags::kTAG_OFFSETS] as $tag=>$one)
  //  //        $tags[]= $one;
  //  //    }
  //  //}
  //  //
  //  //$taxonTag= $tagsClass->getTagBy('GR:TAXON', Tags::kTAG_GID);
  //  //$taxonTagKey= $taxonTag[':WS:RESPONSE']['_ids'][0];
  //  //$taxonTagType= $taxonTag[':WS:RESPONSE']['_tag'][$taxonTag[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_TYPE][0];
  //  //
  //  //$requestManager= new ServerRequestManager();
  //  //$requestManager->setDatabase('PGRSECURE');
  //  //$requestManager->setOperation('WS:OP:GET');
  //  //$requestManager->setCollection(':_units');
  //  //$requestManager->setOperator('$OR');
  //  //$requestManager->setDistinct($taxonTagKey);
  //  //foreach($tags as $key=>$tag)
  //  //  $requestManager->addQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
  //  //$requestManager->setQuery($taxonTagKey, Types::kTYPE_STRING, $word, Operators::kOPERATOR_PREFIX_NOCASE);
  //  //
  //  //$response= $requestManager->sendRequest();
  //  //
  //  //print_r($response);
  //  //return  (array_key_exists(':WS:RESPONSE', $response))? $response[':WS:RESPONSE'] : array('no trait found');
  //  
  //  $traitConnection= new TraitConnection();
  //  $serverConnection = new ServerConnection();
  //  
  //  $trait= $traitConnection->getTrait($traitValue);
  //  $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
  //  
  //  $tagsList= $serverConnection->getTags($features);
  //  
  //  $tags= array();
  //  foreach($tagsList[':WS:RESPONSE']['_tag'] as $key=>$value){
  //      if(count($value[Tags::kTAG_OFFSETS]) > 0){
  //          foreach($value[Tags::kTAG_OFFSETS] as $tag=>$one)
  //          $tags[]= $one;
  //      }
  //  }
  //  
  //  $taxonTag= $serverConnection->getTagByGID('GR:TAXON', Tags::kTAG_GID);
  //  $taxonTagKey= $taxonTag[':WS:RESPONSE']['_ids'][0];
  //  $taxonTagType= $taxonTag[':WS:RESPONSE']['_tag'][$taxonTag[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_TYPE][0];
  //  
  //  $this->setDatabase('PGRSECURE');
  //  $this->setSecondDB('ONTOLOGY');
  //  $this->setCollection(':_units');
  //  $this->setOperator('$OR');
  //  $this->setDistinct($taxonTagKey);
  //  
  //  foreach($tags as $key=>$tag)
  //    $or[]= $this->createNewQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
  //  
  //  $and= Array($this->createNewQuery($taxonTagKey, Types::kTYPE_STRING, $word, Operators::kOPERATOR_PREFIX_NOCASE));
  //    
  //  $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GET', $or, $and, NULL, 0);
  // 
  //  $response= $this->sendRequest($this->wrapper, $params);
  //  
  //  $list= array();
  //  
  //  if(array_key_exists(':WS:RESPONSE', $response)){
  //    $options= $serverConnection->getDistinctDetail($response[':WS:RESPONSE'], $taxonTagType);
  //    foreach($options as $key=>$option){
  //      $list[]=array('GID'=>$option,'LID'=>$option);
  //    }
  //  }else{
  //    $list[]=array('GID'=>'','LABEL'=>'No options found');
  //  }
  //  
  //  return $list;
  //}
  
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