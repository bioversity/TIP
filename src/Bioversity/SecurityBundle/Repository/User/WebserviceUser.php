<?php

namespace Bioversity\SecurityBundle\Repository\User;

use Symfony\Component\Security\Core\User\UserInterface;

class WebserviceUser implements UserInterface
{
    private $email;
    private $profile;
    private $domain;
    private $manager;
    private $username;
    private $password;
    private $salt;
    private $roles;

    public function __construct($username, $email, $profile, array $domain, $manager, $password, $salt, array $roles)
    {
        $this->email= $email;
        $this->profile= $profile;
        $this->domain= $domain;
        $this->manager= $manager;
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getManager()
    {
        return $this->manager;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return '';
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }
}