<?php

namespace Bioversity\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Bioversity\SecurityBundle\Form\BioversityUserType;
use Bioversity\SecurityBundle\Form\BioversityGenericUserType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $webServer= new ServerConnection();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            $userList= $webServer->getUserList();
        }else{
            $userList= array(':WS:RESPONSE'=>array());
        }
        
        $response = $this->render(
            'BioversityUserBundle:User:index.html.twig',
            array(
                'user_list' => $userList[':WS:RESPONSE']
            )
        );
        
        // set the private or shared max age
        $response->setMaxAge(0);
        $response->setSharedMaxAge(0);
    
        return $response;
    }
    
    public function newUserAction(Request $request)
    {        
        $form = $this->createForm(new BioversityUserType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
                $user= $form->getData();
                $saver= new ServerConnection();
                $saver->saveNewUser($user['fullname'], $user['username'], $user['password'], $user['email'], $user['roles']);
                
                return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
            }
        }

        return $this->render('BioversityUserBundle:User:new_user.html.twig', array(
            'form'  => $form->createView(),
        ));
    }
    
    public function deleteAction($code)
    {
        $saver= new ServerConnection();
        $saver->deleteUser($code);
        
        return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
    }
}