<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;
use Bioversity\ServerConnectionBundle\Repository\ServerConnection;
use Bioversity\TraitBundle\Repository\TraitConnection;

class AutocompleteMethod extends HttpServerConnection
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
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    
    if($namespace)
      $lid= $namespace.':'.$lid;
    
    //print_r($lid);
    
    $query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    $query2= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_CONTAINS_NOCASE);
    //$query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_EQUAL);
    //$query2= $this->createQuery(Tags::kTAG_LID, Types::kTYPE_STRING, $lid, Operators::kOPERATOR_EQUAL);
    $params= $this->createRequestWithMultipleQuery('WS:OP:GET', $query1,$query2);
    
    //print_r($this->sendRequest($this->wrapper, $params));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
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
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    
    $query1= $this->createQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $label, Operators::kOPERATOR_CONTAINS_NOCASE);
    $params= $this->createRequest('WS:OP:GET', $query1);
    
    //print_r($this->sendRequest($this->wrapper, $params));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  
  /**
   * Returns the NAMESPACE requested
   * @param string $namespace
   *  
   * @return array $serverResponce
   */
  public function findNAMESPACE($namespace)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    $query= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $namespace, Operators::kOPERATOR_PREFIX);
    $params= $this->createRequest('WS:OP:GET', $query);
    
    //print_r($this->clearResponse($this->sendRequest($this->wrapper, $params)));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  /**
   * Returns the GID requested
   * @param string $gid
   * 
   * @return array $serverResponce
   */
  public function findGID($gid)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_nodes');
    
    $query1= $this->createQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_CONTAINS_NOCASE);
    $params= $this->createRequest('WS:OP:GET', $query1);
    
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }  
  
  /**
   * Returns the TRAIT requested
   * @param string $term
   *  
   * @return array $serverResponce
   */
  public function findTrait($term)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(':_terms');
    $query1= $this->createNewQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $term, Operators::kOPERATOR_CONTAINS_NOCASE);
    $query2= $this->createNewQuery(Tags::kTAG_FEATURES, Types::kTYPE_INT, NULL, Operators::kOPERATOR_NOT_NULL);
    $params= $this->createNewRequest('WS:OP:GET', Array($query1,$query2), NULL, 0);
    
    //print_r($this->clearResponse($this->sendRequest($this->wrapper, $params)));
    return $this->clearResponse($this->sendRequest($this->wrapper, $params));
  }
  
  /**
   * Returns the TAXO requested
   * @param string $term
   * @param string $traitValue
   *  
   * @return array $serverResponce
   */
  public function findTaxo($word, $traitValue)
  {
    $traitConnection= new TraitConnection();
    $serverConnection = new ServerConnection();
    
    $trait= $traitConnection->getTrait($traitValue);
    $features= $trait[':WS:RESPONSE'][0][Tags::kTAG_FEATURES];
    
    $tagsList= $serverConnection->getTags($features);
    
    $tags= array();
    foreach($tagsList[':WS:RESPONSE']['_tag'] as $key=>$value){
        if(count($value[Tags::kTAG_OFFSETS]) > 0){
            foreach($value[Tags::kTAG_OFFSETS] as $tag=>$one)
            $tags[]= $one;
        }
    }
    
    $taxonTag= $serverConnection->getTagByGID('GR:TAXON', Tags::kTAG_GID);
    $taxonTagKey= $taxonTag[':WS:RESPONSE']['_ids'][0];
    $taxonTagType= $taxonTag[':WS:RESPONSE']['_tag'][$taxonTag[':WS:RESPONSE']['_ids'][0]][Tags::kTAG_TYPE][0];
    
    $this->setDatabase('PGRSECURE');
    $this->setSecondDB('ONTOLOGY');
    $this->setCollection(':_units');
    $this->setOperator('$OR');
    $this->setDistinct($taxonTagKey);
    
    foreach($tags as $key=>$tag)
      $or[]= $this->createNewQuery($tag, NULL, NULL, Operators::kOPERATOR_NOT_NULL);
    
    $and= Array($this->createNewQuery($taxonTagKey, Types::kTYPE_STRING, $word, Operators::kOPERATOR_PREFIX_NOCASE));
      
    $params= $this->createFuckingBastardDuplicatedRequest('WS:OP:GET', $or, $and, NULL, 0);
   
    $response= $this->sendRequest($this->wrapper, $params);
    
    $list= array();
    
    if(array_key_exists(':WS:RESPONSE', $response)){
      $options= $serverConnection->getDistinctDetail($response[':WS:RESPONSE'], $taxonTagType);
      foreach($options as $key=>$option){
        $list[]=array('GID'=>$option,'LID'=>$option);
      }
    }else{
      $list[]=array('GID'=>'','LABEL'=>'No options found');
    }
    
    return $list;
  }
  
  public function clearResponse($response)
  {
    $list= array();
    if($response[':WS:STATUS'][':WS:AFFECTED-COUNT'] >= 1){
      $terms= $response[':WS:RESPONSE'];
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