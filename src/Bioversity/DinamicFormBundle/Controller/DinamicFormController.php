<?php

namespace Bioversity\DinamicFormBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Bioversity\ServerConnectionBundle\Form\BioversityDinamicFormType;

class DinamicFormController extends Controller
{
    public function indexAction(Request $request)
    {
        $session= $request->getSession();
        
        $formFields=    Array(24575 => array(
                                24576 => array(709),
                                24578 => array(711,722),
                                24601 => array(731),
                                24598 => array(729, 730)
                            )
                        );
        
        //$formBase = $this->createForm(new BioversityDinamicFormType($formFields));
        
        $dinamicForm= BioversityDinamicFormType::createFieldSet($formFields);
        foreach($dinamicForm as $groups=>$forms){
            foreach($forms as $key=>$form){
                $dinamicForm[$groups][$key]= $this->createForm(new BioversityDinamicFormType($form))->createView();
            }
        }
        
        return $this->render('BioversityDinamicFormBundle:DinamicForm:index.html.twig',
            array(
                'form_base'         => $dinamicForm,
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error'),
            ));
    }
}
