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
	public function indexAction(Request $request )
    {
		$session= $request->getSession();
	    $theForm = $request->get( 'theForm' );

	    //
	    // Local.
	    //
	    $formFields = file_get_contents( "http://localhost/services/Wrappers/PGRDG/ThematicSearch.php?form=$theForm" );

	    //
	    // Server.
	    //
	//    $formFields = file_get_contents( "http://192.168.181.11/PGRDG/ThematicSearch.php?form=$theForm" );

	    $formFields = json_decode( $formFields, TRUE );

        //$formBase = $this->createForm(new BioversityDinamicFormType($formFields));

        $dinamicForm= BioversityDinamicFormType::createFieldSet($formFields);
        foreach($dinamicForm as $groups=>$forms){
            foreach($forms as $key=>$form){
                $dinamicForm[$groups][$key]
	                = $this->createForm(
	                    new BioversityDinamicFormType($form))->createView();
            }
        }

        return $this->render('BioversityDinamicFormBundle:DinamicForm:index.html.twig',
            array(
                'form_base'         => $dinamicForm,
                'notice'            => $session->getFlashBag()->get('notice'),
                'errors'            => $session->getFlashBag()->get('error')
            ));
    }
}
