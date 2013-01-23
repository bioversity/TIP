<?php

namespace Bioversity\SecurityBundle\Repository;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Bioversity\ServerConnectionBundle\Repository\Tags;
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
    $params= $this->createRequest('WS:OP:GET');
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