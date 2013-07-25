<?php

namespace Bioversity\ServerConnectionBundle\Tests\MokClass;

class MokResponse
{
    private $mokedResponse= array(
        ':WS:STATUS'=>array(
            ':STATUS-LEVEL'=>0,
            ':STATUS-CODE'=>0,
            ':WS:AFFECTED-COUNT'=>2
        ),
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
            ),
            ':WS:SELECT'=>array('2','19','20','21','9','10')
        ),
        ':WS:PAGING'=>array(
            ':WS:PAGE-START'=>0,
            ':WS:PAGE-LIMIT'=>50,
            ':WS:PAGE-COUNT'=>10
        ),
        ':WS:RESPONSE'=>array(
            '_ids'=>array(1,271),
            '_term'=>array(
                ':ONTOLOGY'=>array(
                    '19'=>array('en'=>'Ontology'),
                    '2'=>':ONTOLOGY',
                    '20'=>array('en'=>'label')
                ),
                ':LABEL'=>array(
                    '19'=>array('en'=>'Label'),
                    '2'=>':LABEL',
                    '20'=>array('en'=>'description')
                ),
                ':KIND-ROOT'=>array(
                    '19'=>array('en'=>'Root'),
                    '2'=>':KIND-ROOT',
                    '20'=>array('en'=>'An entry point of an ontology')
                )
            ),
            '_node'=>array(
                '1'=>array(
                    '2'=>':ONTOLOGY',
                    '19'=>array('en'=>'Ontology'),
                    '20'=>array('en'=>'An ontology is a graph structure'),
                    '9'=>array(':KIND-ROOT'),
                    '21'=>array('en'=>'This represents the default ontology')
                ),
                '271'=>array(
                    '2'=>'ISO',
                    '19'=>array('en'=>'International Organization for Standardization',
                                'fr'=>'Organisation internationale de normalisation',
                                'ru'=>'\u041c\u0435\u0436\u0434\u0443\u043d\u0430'),
                    '20'=>array('en'=>'Collection of industrial and commercial standards and codes.'),
                    '9'=>array(':KIND-ROOT')
                )
            ),
            '_edge'=>array(),
            '_distinct'=>array(
                '218' => array(
                    'MCPD:SAMPSTAT:100' => 418,
                    'MCPD:SAMPSTAT:999' => 12827,
                    'MCPD:SAMPSTAT:500' => 12057,
                    'MCPD:SAMPSTAT:400' => 15752,
                    'MCPD:SAMPSTAT:300' => 58942,
                )
            ),
            '_tag'=>array(
                '19'=>array(
                    '35'=>array(':LABEL'),
                    '5'=>array('kTERM_LABEL'),
                    '10'=>array(':LSTRING'),
                    '13'=>':INPUT-TEXT',
                    '37'=>0,
                    '41'=>array()
                ),
                '2'=>array(
                    '35'=>array(':GID'),
                    '5'=>array('kTERM_GID'),
                    '10'=>array(':STRING',':REQUIRED',':COMPUTED',':LOCKED'),
                    '13'=>':INPUT-TEXT',
                    '37'=>0,
                    '41'=>array()
                ),
                '20'=>array(
                    '35'=>array(':DEFINITION'),
                    '5'=>array('kTERM_DEFINITION'),
                    '10'=>array(':LTEXT'),
                    '13'=>':INPUT-TEXTAREA',
                    '37'=>0,
                    '41'=>array()
                ),
                '9'=>array(
                    '35'=>array(':KIND'),
                    '5'=>array('kTERM_KIND'),
                    '10'=>array(':SET'),
                    '13'=>':INPUT-MULTIPLE',
                    '37'=>0,
                    '41'=>array()
                ),
                '21'=>array(
                    '35'=>array(':DESCRIPTION'),
                    '5'=>array('kTERM_DESCRIPTION'),
                    '10'=>array(':LTEXT'),
                    '13'=>':INPUT-TEXTAREA',
                    '37'=>0,
                    '41'=>array()
                )
            )
        )
    );
    
    public $response;
    
    public function __construct()
    { 
        $this->response= $this->mokedResponse;
    }
    
    public function getResponse()
    {
        return $this->response;
    }
}