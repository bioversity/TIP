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
			18378 => array
			(
				18379 => array
				(
					18380, 18381, 18382, 18383, 18384, 18385, 18386,
					18392, 18393, 18394, 18395, 18396, 18397, 18398,
					18399, 18400
				),
				18401 => array
				(
					18402, 18403, 18404, 18405, 18406, 18407, 18408,
					18409, 19410, 18411, 18412, 18413, 18414, 18415,
					18416, 18417
				)
			)
	    );

 /*
        $formFields=    Array(24575 => array(
                                24576 => array(709),
                                24578 => array(711,722),
                                24601 => array(731),
                                24598 => array(729, 730)
                            )
                        );
 */
        
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
