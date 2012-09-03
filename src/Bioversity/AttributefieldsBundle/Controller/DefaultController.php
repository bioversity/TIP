<?php

namespace Bioversity\AttributefieldsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Bioversity\AttributefieldsBundle\Document\Attribute;

class DefaultController extends Controller
{
  public function indexAction(Request $request)
  {    
    if ($request->getMethod() == 'POST') {
      $parameters= $_POST;
      $m = $this->get('doctrine.odm.mongodb')->getManager();
      
      // add a record
      $attribute= new Attribute();
      
      foreach($parameters as $parameter=>$value){
        $attribute->setCustomField($parameter, $value);
      }
      
      $m->persist($attribute);
      $m->flush();
    }
     
    return $this->render('BioversityAttributefieldsBundle:Default:index.html.twig');
  }
  
  public function getattributeAction($id)
  {
    $result = $this->get('doctrine.odm.mongodb')
        ->getRepository('BioversityAttributefieldsBundle:Attribute')
        ->find($id);

    //Just convert array to JSON and return result
    return new Response(json_encode($result));
  }
}
