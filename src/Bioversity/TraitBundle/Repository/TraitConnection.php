<?php

namespace Bioversity\TraitBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\InputType;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class TraitConnection
{  
  
  const page_record= 10;
  
  /**
   * Returns the TRAIT list requested
   * @param string $word
   *  
   * @return array $serverResponce
   */
  public function getTraits($word)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setCollection(':_tags');
    $requestManager->setQuery(Tags::kTAG_LABEL.'.en', Types::kTYPE_STRING, $word, Operators::kOPERATOR_CONTAINS_NOCASE);
    $requestManager->addQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    
    return $requestManager->sendRequest();
  } 
  
  /**
   * Returns the TRAIT requested
   * @param string $gid
   *  
   * @return array $serverResponce
   */
  public function getTrait($gid)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_terms');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $gid, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
  
  /**
   * Returns the TAGS list requested
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setCollection(NULL);
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    $requestManager->setQuery(Tags::kTAG_DATAPOINT_REFS, Types::kTYPE_INT, 0, Operators::kOPERATOR_GREAT);
    
    return $requestManager->sendRequest();
  } 
  
  /**
   * Returns the TRIAL list requested
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTrials($structKey, $unit, $page= 0)
  {
    $firstElement= ($page > 1) ? ($page*self::page_record)+1 : 0;
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetSubDocument');
    $requestManager->setSubDocument(array($structKey=>''));
    $requestManager->setCollection(':_units');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_STRING, $unit, Operators::kOPERATOR_EQUAL);
    $requestManager->setPageStart($firstElement);
    
    return $requestManager->sendRequest();
  }    
  
  /**
   * Returns the Unit list requested
   * @param array $nid
   *  
   * @return array $serverResponce
   */
  public function getUnit($nid)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetAnnotated');
    $requestManager->setCollection(':_units');
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_BINARY_STRING, $nid, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }  
  
  /**
   * Returns the Unit list requested
   * @param array $nid
   *  
   * @return array $serverResponce
   */
  public function getUnitByGID($gid)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetAnnotated');
    $requestManager->setCollection(':_units');
    $requestManager->setQuery(Tags::kTAG_GID, Types::kTYPE_BINARY_STRING, $gid, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }  
  
  /**
   * Returns the DATA list requested
   * @param string $tags
   * @param int $page
   *  
   * @return array $serverResponce
   */
  public function getUnits($tags, $page=0)
  {
    $firstElement= 0;
    
    if($page > 1 )
      $firstElement= (self::page_record*($page-1))+1;
      
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetAnnotated');
    $requestManager->setCollection(':_units');
    $requestManager->setPageStart($firstElement);
    $requestManager->setCustomQuery($this->GenQuery($tags));
    
    return $requestManager->sendRequest();
  }
  
  /**
   * Returns the DATA list requested
   * @param string $tags
   * @param int $page
   *  
   * @return array $serverResponce
   */
  public function sendUrl($url)
  {
    $requestManager= new ServerRequestManager();
    
    return $requestManager->sendUrl($url);
  }
  
  /**
   * Returns the DATA summary requested
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getUnitSummary($tags)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetAnnotated');
    $requestManager->setCollection(':_units');
    $requestManager->setCustomQuery($this->GenQuery($tags));
    
    $requestManager->setDistinct(array(Tags::kTAG_DOMAIN));
    
    return $requestManager->sendRequest();
  }
  
  /**
   * Returns the DATA summary requested
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function GetFeatured($tags, $distinct= false, $page= null)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetFeatured');
    $requestManager->setCollection(':_units');
    $requestManager->setOperator(null);
    $requestManager->setCustomQuery($tags);  
      $requestManager->setPageLimit(self::page_record);
    
    if($distinct)
      $requestManager->setDistinct(array(Tags::kTAG_DOMAIN));
      
    if($page){
      $requestManager->setPageStart($page);
    }
    
    return $requestManager->sendRequest();
  }
  
  /**
   * Returns the DATA url requested filtered by domain
   * @param string $tags
   * @param string $domain
   *  
   * @return array $serverResponce
   */
  public function getUnitsFilterByDomain($tags, $domain)
  {
    //Hack to add domain in query fields
    $tags[]= $this->createQuery(Tags::kTAG_DOMAIN,null,$domain);
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetFeatured');
    $requestManager->setCollection(':_units');
    $requestManager->setOperator(null);
    $requestManager->setCustomQuery($tags);
    $requestManager->setPageLimit(self::page_record);
    
    return $requestManager->getRequestUrl();
  }
  
  public function getNextPage($requiredpage= 0)
  {
    //print_r($query->getRequest()->getQuery());
    //$requiredpage= $query->getRequest()->getPageStart();
    return $startpage= ($requiredpage == 0)? 2: (($requiredpage-1)/self::page_record)+2;
    
    //$requestManager= new ServerRequestManager();
    //$requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    //$requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    //$requestManager->setOperation('WS:OP:GetFeatured');
    //$requestManager->setCollection(':_units');
    //$requestManager->setOperator(null);
    //$requestManager->setCustomQuery($query);
    //$requestManager->setPageLimit(10);
    //$requestManager->setPageStart($startpage);
    
    return $requestManager->getRequestUrl();
  }
  
  public function getPrevPage($requiredpage= null)
  {
    //$requiredpage= $query->getRequest()->getPageStart();
    
    if($requiredpage)
      $requiredpage= ($requiredpage-1)/self::page_record;
    //  
    //  $requestManager= new ServerRequestManager();
    //  $requestManager->setDatabase($requestManager->getDatabasePGRSecure());
    //  $requestManager->setSecondDatabase($requestManager->getDatabaseOntology());
    //  $requestManager->setOperation('WS:OP:GetFeatured');
    //  $requestManager->setCollection(':_units');
    //  $requestManager->setCustomQuery($query->getServerResponse()[':WS:REQUEST'][':WS:QUERY']);
    //  $requestManager->setPageLimit(10);
    //  $requestManager->setPageStart($startpage);
    //  
    //  return $requestManager->getRequestUrl();
    //}
    
    return $requiredpage;
  }
  
  function GenQuery( $theData )
  {
    $query = Array();
    $count = count( $theData );
    if( $count )
    {
      $query[ '$AND' ] = Array();
      $ref = & $query[ '$AND' ];
     
      foreach( $theData as $trait => $scales )
      {
        $ref[] = Array();
        $ref_trait = & $ref[ count( $query[ '$AND' ] ) - 1 ];
        
        $ref_trait = array( '$OR' => Array() );
        $ref_trait = & $ref_trait[ '$OR' ];
        
        $group = Array();
        foreach( $scales as $scale => $value )
        {
          $tmp = explode( '.', $scale );
          $group[ $tmp[ count( $tmp ) - 1 ] ][] = array( $scale => $value );
        }
        
        foreach( $group as $tag => $scales )
        {
          $ref_trait[] = Array();
          $ref_scale = & $ref_trait[ count( $ref_trait ) - 1 ];
          $ref_scale[ '$AND' ] = Array();
          $ref_scale = & $ref_scale[ '$AND' ];
          
          if($tag != Tags::kTAG_DOMAIN){
            $ref_scale[] = array( '_query-subject' => '40',
                                  '_query-operator' => '$EQ',
                                  '_query-data-type' => ':INT',
                                  '_query-data' => (int) $tag );
          }
          
          $created = FALSE;
          foreach( $scales as $scale )
          {
            $pass= true;
            
            if(is_array(current( $scale ))){
              foreach(current( $scale ) as $key=>$value){
                if(!$value) $pass= false;
              }
            }else{
              if(!strlen(current( $scale )))
                $pass= false;
            }
            
            if( $pass && count(current( $scale )) > 0)
            {
              if( ! $created )
              {	
                $ref_scale[] = array( '$OR' => Array() );
                $ref_scale = & $ref_scale[ count( $ref_scale ) - 1 ];
                $ref_cur = & $ref_scale[ '$OR' ];
                $created = TRUE;
              }
    
              $key= explode('.',key($scale));
              $keyValue= $key[count($key)-1];
              
              $server= new Tags();
              $tag= $server->getTags(array((string) $keyValue));
              
              $typeList= $tag->getResponse()->getTag()[$keyValue][Tags::kTAG_TYPE];
              
              if(in_array(':INT',$typeList) ||
               in_array(':INT32',$typeList) ||
               in_array(':INT64',$typeList) ||
               in_array(':FLOAT',$typeList)){
                $operator= Operators::kOPERATOR_IRANGE;
                $type= Types::kTYPE_INT;
              }else{
                $operator= (in_array(':ENUM', $typeList) || in_array(':SET', $typeList))?
                            Operators::kOPERATOR_EQUAL:
                            Operators::kOPERATOR_PREFIX;
                            
                $type= Types::kTYPE_STRING;
              }
              
              $ref_cur[]= $this->createQuery((string) key( $scale ), $type, current( $scale ), $operator);
            }
          }
        }
      }
    }
    
    return $query;
  }

  /*
   * Create the query array for the request
   *
   * @param string $subject
   * @param string $type
   * @param string $data
   *
   * @return array $query
   */
  public function createQuery($subject, $type=null, $data=null, $operator = '$EQ')
  {
    $server= new Tags();
    $tag= $server->getTags(array((string) $subject));
    
    $typeList= $tag->getResponse()->getTag()[$subject][Tags::kTAG_TYPE];
    
    if(in_array(':INT',$typeList) ||
     in_array(':INT32',$typeList) ||
     in_array(':INT64',$typeList) ||
     in_array(':FLOAT',$typeList)){
      $operator= Operators::kOPERATOR_IRANGE;
      $type= Types::kTYPE_INT;
    }else{
      $operator= (in_array(':ENUM', $typeList) || in_array(':SET', $typeList))?
                  Operators::kOPERATOR_EQUAL:
                  Operators::kOPERATOR_PREFIX;
                  
      $type= Types::kTYPE_STRING;
    }
              
    if(is_array($data) && $operator != Operators::kOPERATOR_IRANGE)
      $operator= Operators::kOPERATOR_IN;
      
    if($subject == Tags::kTAG_LABEL){
      $subject= $subject.'.'.key($data);
      $data= $data[key($data)];
      $operator= Operators::kOPERATOR_CONTAINS_NOCASE;
    }
    
    if(
      $subject == Tags::kTAG_KIND ||
      $subject == Tags::kTAG_TYPE ||
      $subject == Tags::kTAG_SYNONYMS ||
      $subject == Tags::kTAG_CATEGORY
      ){
      $operator= Operators::kOPERATOR_IN;
    }
    
    $query= Array(
      '_query-subject'=>$subject,
      '_query-operator'=>$operator
    );
    
    if($type){
      if($subject == Tags::kTAG_TAGS )
        $type= Types::kTYPE_INT;
        
      $query['_query-data-type']= $type;
    }
    
    if($data !== null)
      $query['_query-data']= $data;
    
    
    
    return $query;
  }
  
  public function createAND($list)
  {
    $and=array();
    foreach($list as $key=>$tag){
      $and['$AND'][]= Array('$OR' => $this->createOR($tag));
    }
    
    $keys= $this->getTagKey($list);
    
    return $and;
  }
  
  public function createOR($list)
  {
    //print_r($list);
    
    $or=array();
    $query= array();
    $count= 0;
    
    foreach($list as $key=>$value){
      if(strpos($key, '.') === false)
        $query[]= $this->createNewQuery(Tags::kTAG_TAGS, Types::kTYPE_INT, $key, Operators::kOPERATOR_EQUAL);
      
      if(count($list) == 1){
        if($value)
          $query[]= $this->createNewQuery($key, Types::kTYPE_STRING, $value, Operators::kOPERATOR_EQUAL);
      }else{
        $query[$count]['$OR'][]= $this->createNewQuery($key, Types::kTYPE_STRING, $value, Operators::kOPERATOR_EQUAL);
      }
      
    }
    $or[]['$AND']= $query;
    
    return $or;
  }
  
  public function getTagKey($list)
  {
    $keys= array();
    foreach($list as $key=>$value){
      $keys[]= array_values(array_unique(array_keys($value)));
    }
    
    $tagkey= array();
    foreach($keys as $key=>$value){
      if(is_array($value)){
        foreach($value as $val=>$tag){
          if(strpos($tag, '.') === false)
            $tagkey[]= $tag;
        }
      }else{
        $tagkey[]= $value[0];
      }
    }
    
    return $tagkey;
  }
  
  private function unformatQuery($tags, $page=0)
  {
    return $this->GenQuery($tags);
  }
}