<?php

namespace Bioversity\ServerConnectionBundle\Repository;

class ServerResponseResponseManager
{
    protected $ids;
    protected $term;
    protected $tag;
    protected $node;
    protected $edge;
    protected $unit;
    protected $allResponse;
    
    public function __construct($response)
    {
        $this->allResponse= $response;
        if($response){
            array_key_exists('_ids', $response)?  $this->setIds($response['_ids']):null;
            array_key_exists('_term', $response)? $this->setTerm($response['_term']):null;
            array_key_exists('_tag', $response)?  $this->setTag($response['_tag']):null;
            array_key_exists('_node', $response)? $this->setNode($response['_node']):null;
            array_key_exists('_edge', $response)? $this->setEdge($response['_edge']):null;
            array_key_exists('_unit', $response)? $this->setUnit($response['_unit']):null;
        }
    }
    
    public function getKey($key)
    {
        return $this->allResponse[$key];
    }
    
    public function setKey($key, $value)
    {
        $this->allResponse[$key]= $value;
    }
    
    public function getAllResponse()
    {
        return $this->allResponse;
    }
    
    public function getIds()
    {
        return $this->ids;
    }
    
    public function getTerm()
    {
        return $this->term;
    }
    
    public function getTag()
    {
        return $this->tag;
    }
    
    public function getNode()
    {
        return $this->node;
    }
    
    public function getEdge()
    {
        return $this->edge;
    }
    
    public function getUnit()
    {
        return $this->unit;
    }
    
    public function setAllResponse($response)
    {
        $this->allResponse= $response;
    }
    
    public function setIds($ids)
    {
        $this->ids=$ids;
    }
    
    public function setTag($tag)
    {
        $this->tag=$tag;
    }
    
    public function setTerm($term)
    {
        $this->term=$term;
    }
    
    public function setEdge($edge)
    {
        $this->edge=$edge;
    }
    
    public function setUnit($unit)
    {
        $this->unit=$unit;
    }
    
    public function setNode($node)
    {
        $this->node=$node;
    }
    
}
