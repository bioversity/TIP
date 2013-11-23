<?php

namespace Bioversity\SecurityBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;
use Bioversity\ServerConnectionBundle\Repository\ServerResponseManager;

class ServerConnection
{
  /**
   * check if user is able to login
   * 
   * @param string $username
   *  
   * @return array $serverResponce
   */
  public function findUserForAuthentication($username)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseUsers());
    $requestManager->setOperation('WS:OP:GET-ONE');
    $requestManager->setCollection(':_entities');
    $requestManager->setQuery(Tags::kTAG_USER_CODE,Types::kTYPE_STRING, $username, Operators::kOPERATOR_EQUAL);
    $requestManager->addQuery(Tags::kTAG_USER_DOMAIN,Types::kTYPE_STRING,'TIP', Operators::kOPERATOR_EQUAL);

    return $requestManager->sendRequest();
  }
  
  /**
   * Returns the user list
   *  
   * @return array $serverResponce
   */
  public function getUserList()
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseUsers());
    $requestManager->setOperation('WS:OP:GET');
    $requestManager->setCollection(':_entities');
    $requestManager->setQuery(Tags::kTAG_USER_DOMAIN,Types::kTYPE_STRING,'TIP', Operators::kOPERATOR_EQUAL);

    return $requestManager->sendRequest();
  }
  
  /**
   * Create new user
   *
   * @param array $userData
   */
  public function saveNewUser($userData, $role= null)
  {
    $object= array();
    foreach($userData as $key=>$value){
      $object[$key]= $value;
    }
    $object[Tags::kTAG_USER_DOMAIN]= 'TIP';
    
    if($role)
      $object[Tags::kTAG_USER_ROLE]= $role;
   
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseUsers());
    $requestManager->setOperation('WS:OP:NewUser');
    $requestManager->setCollection(':_entities');
    $requestManager->setObject($object);
    
    return $requestManager->sendRequest();
  }
  
  /**
   * Edit new user
   *
   * @param array $userData
   */
  public function updateNewUser($userData)
  {
    $criteria= array();
    foreach($userData as $key=>$value){
      $criteria[$key]= array(0 => $value);
    }   
    
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseUsers());
    $requestManager->setOperation('WS:OP:MODIFY');
    $requestManager->setCollection(':_entities');
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_STRING, $userData[Tags::kTAG_USER_CODE], Operators::kOPERATOR_EQUAL, false);
    $requestManager->setCriteria($criteria);
    
    return $requestManager->sendRequest();
    //
    //$query= $this->createQuery(Tags::kTAG_USER_CODE, Types::kTYPE_STRING, $userData[Tags::kTAG_USER_CODE], Operators::kOPERATOR_EQUAL);
    //$params= $this->createRequest('WS:OP:MODIFY', $query);
    //$params[]= ':WS:CRITERIA='.urlencode(json_encode($criteria));
    //
    //return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Delete user
   *
   * @param string $id
   */
  public function deleteUser($id)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseUsers());
    $requestManager->setOperation('WS:OP:DELETE');
    $requestManager->setCollection(':_entities');
    $requestManager->setObject($id);
    $requestManager->setQuery(Tags::kTAG_USER_CODE,'_id', $id, Operators::kOPERATOR_EQUAL);
    $requestManager->addQuery(Tags::kTAG_USER_DOMAIN,Types::kTYPE_STRING,'TIP', Operators::kOPERATOR_EQUAL);
    $requestManager->setPageStart(null);
    
    return $requestManager->sendRequest();
  
    //$params = array(
    //  ':WS:FORMAT=:JSON',
    //  ':WS:OPERATION=WS:OP:DELETE',
    //  ':WS:DATABASE='.urlencode(json_encode($this->db)),
    //  ':WS:CONTAINER='.urlencode(json_encode($this->collection)),
    //  ':WS:OBJECT='.urlencode(json_encode($id))
    //);
    //
    //$query= $this->createQuery(Tags::kTAG_USER_CODE,'_id', $id);
    //$params= $this->createRequest('WS:OP:DELETE', $query);
    //return $this->sendRequest($this->wrapper, $params);
  }
}