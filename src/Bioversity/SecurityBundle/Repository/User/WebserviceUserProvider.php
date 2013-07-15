<?php   

namespace Bioversity\SecurityBundle\Repository\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Bioversity\SecurityBundle\Repository\ServerConnection;
use Bioversity\SecurityBundle\Repository\User\WebserviceUser;
use Bioversity\ServerConnectionBundle\Repository\Tags;

class WebserviceUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $WebServer= new ServerConnection();
        $userData = $WebServer->findUserForAuthentication($username);
        
        if ($userData->getStatus()->getAffectedCount() > 0) {
            $email= $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_MAIL];
            $profile= $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_PROFILE];
            $manager= $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_MANAGER];
            $domain= array( $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_DOMAIN]);
            $password = $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_PASS];
            $roles= $userData->getResponse()->getAllResponse()[Tags::kTAG_USER_ROLE];
            $salt= '';
            
            return new WebserviceUser($username, $email, $profile, $domain, $manager, $password, $salt, $roles);
        }

        throw new UsernameNotFoundException(sprintf('Nome utente "%s" non trovato.', $username));
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof WebserviceUser) {
            throw new UnsupportedUserException(sprintf('Istanza di "%s" non supportata.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'Bioversity\SecurityBundle\Repository\User\WebserviceUser';
    }
}