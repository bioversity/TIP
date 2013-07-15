<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseRequestManager;

class ServerQueryManager
{
    protected $querySubject;
    protected $queryOperator;
    protected $queryDataType;
    protected $queryData;
    
    public function getQuery()
    {
        return array(
                        '_query-subject'  => $this->querySubject,
                        '_query-operator' => $this->queryOperator,
                        '_query-data-type'=> $this->queryDataType,
                        '_query-data'     => $this->queryData
                      );
    }
    
    public function setQuery($subject, $type=null, $data=null, $operator = '$EQ')
    {
        //if(is_array($data) && $operator != Operators::kOPERATOR_IRANGE)
        //  $operator= Operators::kOPERATOR_IN;
          
        if($subject == Tags::kTAG_LABEL){
          $subject= $subject.'.'.key($data);
          $data= $data[key($data)];
          $operator= Operators::kOPERATOR_CONTAINS_NOCASE;
        }
        
        //if(
        //  $subject == Tags::kTAG_KIND ||
        //  $subject == Tags::kTAG_TYPE ||
        //  $subject == Tags::kTAG_SYNONYMS ||
        //  $subject == Tags::kTAG_CATEGORY
        //  ){
        //  $operator= Operators::kOPERATOR_IN;
        //}
        
        $query= Array(
          $this->setQuerySubject($subject),
          $this->setQueryOperator($operator),
        );
        
        if($type){
          if($subject == Tags::kTAG_TAGS )
            $type= Types::kTYPE_INT;
            
          $this->setQueryDataType($type);
        }
        
        if($data !== null)
          $this->setQueryData($data);
          
        return $this->getQuery();
    }
    
    public function getQuerySubject()
    {
        return $this->querySubject;
    }
    
    public function setQuerySubject($querySubject)
    {
        $this->querySubject= $querySubject;
    }
    
    public function getQueryOperator()
    {
        return $this->queryOperator;
    }
    
    public function setQueryOperator($queryOperator)
    {
        $this->queryOperator= $queryOperator;
    }
    
    public function getQueryDataType()
    {
        return $this->queryDataType;
    }
    
    public function setQueryDataType($queryDataType)
    {
        $this->queryDataType= $queryDataType;
    }
    
    public function getQueryData()
    {
        return $this->queryData;
    }
    
    public function setQueryData($queryData)
    {
        $this->queryData=$queryData;
    }
}
