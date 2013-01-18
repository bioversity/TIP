<?php

namespace Bioversity\OntologyBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
{
  
  /**
   * Returns the tags language list
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $this->setDatabase('ONTOLOGY');
    $this->setCollection(NULL);
    $query= $this->createQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    $params= $this->createRequest('WS:OP:GetTag', $query);
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Create new user
   *
   * @param string $fullname
   * @param string $username
   * @param string $password
   * @param string $email
   * @param array $roles
   * @param array $profile
   */
  public function saveNewUser($fullname, $username, $password, $email, $roles, $profile= NULL)
  {
    $object = array(
      Tags::kTAG_USER_NAME => $fullname,
      Tags::kTAG_USER_CODE => $username,
      Tags::kTAG_USER_PASS => $password,
      Tags::kTAG_USER_MAIL => $email,
      Tags::kTAG_USER_ROLE => $roles,
      Tags::kTAG_USER_PROFILE => array( 'un', 'po', 'di', 'roba' ),
      //Tags::kTAG_USER_MANAGER => 'Codice dell\'utente manager',
      Tags::kTAG_USER_DOMAIN  => 'TIP'
    );
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:NewUser',
      ':WS:DATABASE='.urlencode(json_encode($this->db)),
      ':WS:CONTAINER='.urlencode(json_encode($this->collection)),
      ':WS:OBJECT='.urlencode(json_encode($object))
      );        
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Edit new user
   *
   * @param string $fullname
   * @param string $username
   * @param string $password
   * @param string $email
   * @param array $roles
   * @param array $profile
   */
  public function updateNewUser($fullname, $username, $password, $email, $roles, $profile= NULL)
  {
    $object = array(
      Tags::kTAG_USER_NAME => $fullname,
      Tags::kTAG_USER_CODE => $username,
      Tags::kTAG_USER_PASS => $password,
      Tags::kTAG_USER_MAIL => $email,
      Tags::kTAG_USER_ROLE => $roles,
      Tags::kTAG_USER_PROFILE => array( 'un', 'po', 'di', 'roba' ),
      //Tags::kTAG_USER_MANAGER => 'Codice dell\'utente manager',
      Tags::kTAG_USER_DOMAIN  => 'TIP'
    );
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:NewUser',
      ':WS:DATABASE='.urlencode(json_encode($this->db)),
      ':WS:CONTAINER='.urlencode(json_encode($this->collection)),
      ':WS:OBJECT='.urlencode(json_encode($object))
      );        
    
    return $this->sendRequest($this->wrapper, $params);
  }
}