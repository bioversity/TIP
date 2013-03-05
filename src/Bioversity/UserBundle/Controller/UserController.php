<?php

namespace Bioversity\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Bioversity\SecurityBundle\Form\BioversityUserType;
use Bioversity\SecurityBundle\Form\BioversityGenericUserType;
use Bioversity\SecurityBundle\Repository\NotificationManager;
use Bioversity\SecurityBundle\Repository\User\WebserviceUser;
use Bioversity\ServerConnectionBundle\Repository\Tags;
use Bioversity\ServerConnectionBundle\Repository\DataFormatterHelper;

class UserController extends Controller
{
    public function indexAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $webServer= new ServerConnection();
        
        if($this->get('security.context')->isGranted('ROLE_ADMIN')){
            $userList= $webServer->getUserList();
        }else{
            $userList= array(':WS:RESPONSE'=>array());
        }
        
        $response = $this->render(
            'BioversityUserBundle:User:index.html.twig',
            array(
                'user_list' => $userList[':WS:RESPONSE'],
                'notice' => $session->getFlashBag()->get('notice'),
                'errors' => $session->getFlashBag()->get('error')
            )
        );
    
        return $response;
    }
    
    public function newUserAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        $form = $this->createForm(new BioversityUserType());
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);
        
            if ($form->isValid()) {
               $this->saveUser($session, $form, 'saveNewUser');
            }
        }
        
        return $this->render('BioversityUserBundle:User:new_user.html.twig', array(
            'form'   => $form->createView(),
            'notice' => $session->getFlashBag()->get('notice'),
            'errors' => $session->getFlashBag()->get('error')
        ));
    }
    
    public function editUserAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        
        
        $server= new ServerConnection();
        $user= $server->findUserForAuthentication($request->get('code'));
        
        $form = $this->createForm(new BioversityUserType());
        $formClass= new BioversityUserType();
        
        if(array_key_exists(':WS:RESPONSE', $user)){
            foreach($formClass->getFields() as $key){
                if(array_key_exists($key, $user[':WS:RESPONSE']))
                    $form->get($key)->setData($user[':WS:RESPONSE'][$key]);
            }
            //TO-DO: need to find a solution for Role field
            $form->get(Tags::kTAG_USER_ROLE)->setData($user[':WS:RESPONSE'][Tags::kTAG_USER_ROLE]);
        }else{
            $session->getFlashBag()->set('error', NotificationManager::getNotice('not_found'));
            
            return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
        }
        
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);        
            if ($form->isValid()) {                
               $this->saveUser($session, $form, 'updateNewUser');
            }
        }

        return $this->render('BioversityUserBundle:User:edit_user.html.twig', array(
            'form'   => $form->createView(),
            'notice' => $session->getFlashBag()->get('notice'),
            'errors' => $session->getFlashBag()->get('errors')
        ));
    }
    
    public function deleteAction($code)
    {
        $saver= new ServerConnection();
        $delete= $saver->deleteUser($code);
        
        return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
    }
    
    private function saveUser($session, $form, $action)
    {
        $user= $form->getData();
        $saver= new ServerConnection();
        $save= $saver->$action(DataFormatterHelper::clearSubmittedData($user));
        
        if($save[':WS:STATUS'][':STATUS-CODE'] === 0){
            $session->getFlashBag()->set('notice',  NotificationManager::getNotice($save[':WS:STATUS'][':STATUS-CODE']) );
            return $this->redirect($this->generateUrl('bioversity_user_homepage'), 301);
        }else{
            $session->getFlashBag()->set('errors', NotificationManager::getNotice($save[':WS:STATUS'][':STATUS-CODE']) );
        }   
    }
}