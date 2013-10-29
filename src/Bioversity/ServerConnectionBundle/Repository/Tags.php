<?php

namespace Bioversity\ServerConnectionBundle\Repository;

use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\Operators;
use Bioversity\ServerConnectionBundle\Repository\ServerQueryManager;
use Bioversity\ServerConnectionBundle\Repository\ServerRequestManager;

class Tags
{
  const kTAG_NID= '_id';
  const kTAG_LID= '1';
  const kTAG_GID= '2';
  const kTAG_UID= '3';
  const kTAG_PID= '4';
  const kTAG_CURRENT= '1583';
  const kTAG_SYNONYMS= '5';
  const kTAG_DOMAIN= '6';
  const kTAG_AUTHORITY= '7';
  const kTAG_CATEGORY= '8';
  const kTAG_KIND= '9';
  const kTAG_TYPE= '10';
  const kTAG_CLASS= '11';
  const kTAG_NAMESPACE= '12';
  const kTAG_INPUT= '13';
  const kTAG_PATTERN= '14';
  const kTAG_LENGTH= '15';
  const kTAG_MIN_VAL= '16';
  const kTAG_MAX_VAL= '17';
  const kTAG_NAME= '18';
  const kTAG_LABEL= '19';
  const kTAG_DEFINITION= '20';
  const kTAG_DESCRIPTION= '21';
  const kTAG_NOTES= '22';
  const kTAG_EXAMPLES= '23';
  const kTAG_AUTHORS= '24';
  const kTAG_ACKNOWLEDGMENTS= '25';
  const kTAG_BIBLIOGRAPHY= '26';
  const kTAG_VERSION= '27';
  const kTAG_UNIT= '28';
  const kTAG_ENTITY= '1584';
  const kTAG_TERM= '29';
  const kTAG_NODE= '30';
  const kTAG_TAG= '31';
  const kTAG_SUBJECT= '32';
  const kTAG_OBJECT= '33';
  const kTAG_PREDICATE= '34';
  const kTAG_PATH= '35';
  const kTAG_NAMESPACE_REFS= '36';
  const kTAG_DATAPOINT_REFS= '37';
  const kTAG_NODES= '38';
  const kTAG_EDGES= '39';
  const kTAG_TAGS= '40';
  const kTAG_OFFSETS= '41';
  const kTAG_FEATURES= '42';
  const kTAG_METHODS= '43';
  const kTAG_SCALES= '44';
  const kTAG_COORDINATES= '1596';
  const kTAG_ELEVATION= '1597';
  const kTAG_COUNTRY= '1598';
  const kTAG_ADMIN1= '1599';
  const kTAG_ADMIN2= '1600';
  const kTAG_ADMIN3= '1601';
  const kTAG_GENS= '1602';
  const kTAG_GENS_CLIM= '1603';
  const kTAG_GENS_ENV= '1604';
  const kTAG_BIO1= '1605';
  const kTAG_BIO2= '1606';
  const kTAG_BIO3= '1607';
  const kTAG_BIO4= '1608';
  const kTAG_BIO5= '1609';
  const kTAG_BIO6= '1610';
  const kTAG_BIO7= '1611';
  const kTAG_BIO8= '1612';
  const kTAG_BIO9= '1613';
  const kTAG_BIO10= '1614';
  const kTAG_BIO11= '1615';
  const kTAG_BIO12= '1616';
  const kTAG_BIO13= '1617';
  const kTAG_BIO14= '1618';
  const kTAG_BIO15= '1619';
  const kTAG_BIO16= '1620';
  const kTAG_BIO17= '1621';
  const kTAG_BIO18= '1622';
  const kTAG_BIO19= '1623';
  const kTAG_TEMP01= '1624';
  const kTAG_TEMP02= '1625';
  const kTAG_TEMP03= '1626';
  const kTAG_TEMP04= '1627';
  const kTAG_TEMP05= '1628';
  const kTAG_TEMP06= '1629';
  const kTAG_TEMP07= '1630';
  const kTAG_TEMP08= '1631';
  const kTAG_TEMP09= '1632';
  const kTAG_TEMP10= '1633';
  const kTAG_TEMP11= '1634';
  const kTAG_TEMP12= '1635';
  const kTAG_PREC01= '1636';
  const kTAG_PREC02= '1637';
  const kTAG_PREC03= '1638';
  const kTAG_PREC04= '1639';
  const kTAG_PREC05= '1640';
  const kTAG_PREC06= '1641';
  const kTAG_PREC07= '1642';
  const kTAG_PREC08= '1643';
  const kTAG_PREC09= '1644';
  const kTAG_PREC10= '1645';
  const kTAG_PREC11= '1646';
  const kTAG_PREC12= '1647';
  const kTAG_FIRST_NAME= '1585';
  const kTAG_LAST_NAME= '1586';
  const kTAG_MAIL= '1587';
  const kTAG_EMAIL= '1588';
  const kTAG_PHONE= '1589';
  const kTAG_FAX= '1560';
  const kTAG_WEB_SITE= '1561';
  const kTAG_AFFILIATION= '1562';
  const kTAG_NATIONALITY= '1563';
  const kTAG_ENTITY_KIND= '1564';
  const kTAG_ENTITY_TYPE= '1565';
  const kTAG_USER_NAME= '45';
  const kTAG_USER_CODE= '46';
  const kTAG_USER_PASS= '47';
  const kTAG_USER_MAIL= '48';
  const kTAG_USER_ROLE= '49';
  const kTAG_USER_PROFILE= '50';
  const kTAG_USER_MANAGER= '51';
  const kTAG_USER_DOMAIN= '52';
  const kTAG_USER_INSTITUTE_CODE= '53';
  const kTAG_USER_INSTITUTE_NAME= '54';
  const kTAG_USER_INSTITUTE_ADDRESS= '55';
  const kTAG_USER_INSTITUTE_COUNTRY= '56';
  const kTAG_USER_SOCIAL_NETWORK= '57';
  const kTAG_CUSTOM_TYPE= 'type';
  const kTAG_CUSTOM_DATA= 'data';
  const kTAG_STAMP_SEC= 'sec';
  const kTAG_STAMP_USEC= 'usec';
  
   
  /**
   * Returns the tags language list
   * @param string $tags
   *  
   * @return array $serverResponce
   */
  public function getTags($tags)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setQuery(Tags::kTAG_NID, Types::kTYPE_INT, $tags, Operators::kOPERATOR_IN);
    
    return $requestManager->sendRequest();
  }

  /**
   * This method return the server response for requested tag
   * @param string $tag
   * @param const $field (es: Tags::kTAG_GID)
   *
   * @return array $requestManager
   */
  public function getTagBy($tag, $field)
  {
    $requestManager= new ServerRequestManager();
    $requestManager->setDatabase($requestManager->getDatabaseOntology());
    $requestManager->setOperation('WS:OP:GetTag');
    $requestManager->setCollection(':_tags');
    $requestManager->setPageLimit(50);
    $requestManager->setQuery($field, Types::kTYPE_STRING, $tag, Operators::kOPERATOR_EQUAL);
    
    return $requestManager->sendRequest();
  }
}
