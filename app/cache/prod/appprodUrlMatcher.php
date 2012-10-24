<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appprodUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // bioversity_ontology_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'bioversity_ontology_homepage');
            }

            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::indexAction',  '_route' => 'bioversity_ontology_homepage',);
        }

        // bioversity_ontology_user_registration
        if ($pathinfo === '/registration') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::registrationAction',  '_route' => 'bioversity_ontology_user_registration',);
        }

        // bioversity_ontology_user_login
        if ($pathinfo === '/login') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::loginAction',  '_route' => 'bioversity_ontology_user_login',);
        }

        // bioversity_ontology_contact
        if ($pathinfo === '/contact') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::contactAction',  '_route' => 'bioversity_ontology_contact',);
        }

        // bioversity_ontology_about
        if ($pathinfo === '/about') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::aboutAction',  '_route' => 'bioversity_ontology_about',);
        }

        // bioversity_ontology_database
        if ($pathinfo === '/database') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::databaseAction',  '_route' => 'bioversity_ontology_database',);
        }

        // bioversity_ontology_browse_landrace
        if ($pathinfo === '/browse-landrace') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browseLandraceAction',  '_route' => 'bioversity_ontology_browse_landrace',);
        }

        // bioversity_ontology_browse_cwr
        if ($pathinfo === '/browse-cwr') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browse_CwrAction',  '_route' => 'bioversity_ontology_browse_cwr',);
        }

        // bioversity_ontology_browse_trait
        if ($pathinfo === '/browse-trait') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browseTraitAction',  '_route' => 'bioversity_ontology_browse_trait',);
        }

        // bioversity_ontology_dashboard
        if ($pathinfo === '/dashboard') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::dashboardAction',  '_route' => 'bioversity_ontology_dashboard',);
        }

        // bioversity_ontology_edit_profile
        if ($pathinfo === '/edit-profile') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::editProfileAction',  '_route' => 'bioversity_ontology_edit_profile',);
        }

        // bioversity_ontology_datasets
        if ($pathinfo === '/datasets') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::datasetsAction',  '_route' => 'bioversity_ontology_datasets',);
        }

        // bioversity_ontology_data_search
        if ($pathinfo === '/data-search') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::dataSearchAction',  '_route' => 'bioversity_ontology_data_search',);
        }

        // bioversity_ontology_download_data
        if ($pathinfo === '/download-data') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::downloadDataAction',  '_route' => 'bioversity_ontology_download_data',);
        }

        // bioversity_ontology_request_data
        if ($pathinfo === '/request-data') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::requestDataAction',  '_route' => 'bioversity_ontology_request_data',);
        }

        // bioversity_ontology_contribute_data
        if ($pathinfo === '/contribute-data') {
            return array (  '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::contributeDataAction',  '_route' => 'bioversity_ontology_contribute_data',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
