<?php

namespace Bioversity\ServerConnectionBundle\Tests\MokClass;

class MokRequest
{
    private $mokedRequest= array(
        ':WS:REQUEST'=>array(
            ':WS:FORMAT'=>':JSON',
            ':WS:OPERATION'=>'WS:OP:GetVertex',
            ':WS:DATABASE'=>'ONTOLOGY',
            ':WS:CONTAINER'=>':_nodes',
            ':WS:PAGE-LIMIT'=>50,
            ':WS:QUERY'=>array(
                '$AND'=>array(
                    '_query-subject'=>'9',
                    '_query-operator'=>'$EQ',
                    '_query-data-type'=>':TEXT',
                    '_query-data'=>':KIND-ROOT'
                )
            )
        )
    );
    
    public $request;
    
    public function __construct()
    { 
        $this->request= $this->mokedRequest;
    }
    
    public function getRequest()
    {
        return $this->request;
    }
}