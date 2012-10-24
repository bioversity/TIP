<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * appprodUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appprodUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    static private $declaredRoutes = array(
        'bioversity_ontology_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),),
        'bioversity_ontology_user_registration' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::registrationAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/registration',    ),  ),),
        'bioversity_ontology_user_login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),),
        'bioversity_ontology_contact' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::contactAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/contact',    ),  ),),
        'bioversity_ontology_about' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::aboutAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/about',    ),  ),),
        'bioversity_ontology_database' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::databaseAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/database',    ),  ),),
        'bioversity_ontology_browse_landrace' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browseLandraceAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/browse-landrace',    ),  ),),
        'bioversity_ontology_browse_cwr' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browse_CwrAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/browse-cwr',    ),  ),),
        'bioversity_ontology_browse_trait' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::browseTraitAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/browse-trait',    ),  ),),
        'bioversity_ontology_dashboard' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::dashboardAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/dashboard',    ),  ),),
        'bioversity_ontology_edit_profile' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::editProfileAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/edit-profile',    ),  ),),
        'bioversity_ontology_datasets' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::datasetsAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/datasets',    ),  ),),
        'bioversity_ontology_data_search' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::dataSearchAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/data-search',    ),  ),),
        'bioversity_ontology_download_data' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::downloadDataAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/download-data',    ),  ),),
        'bioversity_ontology_request_data' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::requestDataAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/request-data',    ),  ),),
        'bioversity_ontology_contribute_data' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Bioversity\\OntologyBundle\\Controller\\DefaultController::contributeDataAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/contribute-data',    ),  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $absolute = false)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Route "%s" does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $absolute);
    }
}
