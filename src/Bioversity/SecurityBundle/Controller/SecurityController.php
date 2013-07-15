<?php

namespace Bioversity\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SecurityBundle\Form\BioversityUserRegistrationType;
use Bioversity\SecurityBundle\Form\BioversityGenericUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Validator\Constraints\Collection;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        
        $request = $this->getRequest();
        $session = $request->getSession();
        
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('BioversitySecurityBundle:Security:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }
    
    public function registrationAction(Request $request)
    { 
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new BioversityUserRegistrationType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $saver= new ServerConnection();
                $saver->saveNewUser($form->getData(), 'ROLE_ANONYMUS');
                return $this->redirect($this->generateUrl('b_s_login_path'), 301);
            }
        }
        
        return $this->render('BioversitySecurityBundle:Security:registration.html.twig', array(
            'form'   => $form->createView(),
            'notice' => $session->getFlashBag()->get('notice'),
            'errors' => $session->getFlashBag()->get('error')
        ));
    }
}