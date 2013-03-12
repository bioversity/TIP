<?php

namespace Bioversity\SecurityBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Types;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\HttpServerConnection;

class ServerConnection extends HttpServerConnection
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
    $query1= $this->createQuery(Tags::kTAG_USER_CODE,':TEXT', $username);
    $query2= $this->createQuery(Tags::kTAG_USER_DOMAIN,':TEXT',$this->domain);
    $params= $this->createRequest('WS:OP:GET-ONE',$query1,$query2);
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the user list
   *  
   * @return array $serverResponce
   */
  public function getUserList()
  {
    $query= $this->createQuery(Tags::kTAG_USER_DOMAIN,':TEXT',$this->domain);
    $params= $this->createRequest('WS:OP:GET', $query);
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Returns the dataset user list
   *  
   * @return array $serverResponce
   */
  public function getDatasetUserList()
  {
    $query1= $this->createQuery(Tags::kTAG_USER_ROLE,':TEXT', 'ROLE_DATASET_USER');
    $query2= $this->createQuery(Tags::kTAG_USER_DOMAIN,':TEXT', $this->domain);
    $params= $this->createRequest('WS:OP:GET', $query1,$query2);
    return $this->sendRequest($this->wrapper, $params);
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
   * @param array $userData
   */
  public function updateNewUser($userData)
  {
    $criteria= array();
    foreach($userData as $key=>$value){
      $criteria[$key]= array(0 => $value);
    }
    
    $query= $this->createQuery(Tags::kTAG_USER_CODE, Types::kTYPE_STRING, $userData[Tags::kTAG_USER_CODE], Operators::kOPERATOR_EQUAL);
    $params= $this->createRequest('WS:OP:MODIFY', $query);
    $params[]= ':WS:CRITERIA='.urlencode(json_encode($criteria));
    
    return $this->sendRequest($this->wrapper, $params);
  }
  
  /**
   * Delete user
   *
   * @param string $id
   */
  public function deleteUser($id)
  {
    $params = array(
      ':WS:FORMAT=:JSON',
      ':WS:OPERATION=WS:OP:DELETE',
      ':WS:DATABASE='.urlencode(json_encode($this->db)),
      ':WS:CONTAINER='.urlencode(json_encode($this->collection)),
      ':WS:OBJECT='.urlencode(json_encode($id))
    );

    $query= $this->createQuery(Tags::kTAG_USER_CODE,'_id', $id);
    $params= $this->createRequest('WS:OP:DELETE', $query);
    return $this->sendRequest($this->wrapper, $params);
  }
}