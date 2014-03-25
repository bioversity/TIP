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

	    $formFields = array
	    (
		    18129 => array
			(
			    18130 => array( 522, 523 ),
			    18133 => array( 524, 525, 526 ),
			    18137 => array( 527, 528, 529, 530, 531, 532 ),
			    18144 => array( 533, 534, 535, 536, 537, 538, 539, 540, 541 ),
			    18154 => array( 452, 543, 544 ),
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
