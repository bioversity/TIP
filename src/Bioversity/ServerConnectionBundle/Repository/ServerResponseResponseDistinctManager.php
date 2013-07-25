<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class ServerResponseResponseDistinctManager extends \ArrayObject
{
    public function getTags(){
        return array_keys($this->getArrayCopy());
    }
    
    public function getTagsValues($tag= null){
        return $this->offsetExists($tag)? $this->offsetGet($tag): null;
    }
}