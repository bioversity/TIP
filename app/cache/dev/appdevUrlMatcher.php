<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appdevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appdevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        // _assetic_487a3c1
        if ($pathinfo === '/js/487a3c1.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_487a3c1',);
        }

        // _assetic_487a3c1_0
        if ($pathinfo === '/js/487a3c1_arbor_1.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => '0',  '_format' => 'js',  '_route' => '_assetic_487a3c1_0',);
        }

        // _assetic_487a3c1_1
        if ($pathinfo === '/js/487a3c1_arbor-tween_2.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => '1',  '_format' => 'js',  '_route' => '_assetic_487a3c1_1',);
        }

        // _assetic_487a3c1_2
        if ($pathinfo === '/js/487a3c1_graphics_3.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => '2',  '_format' => 'js',  '_route' => '_assetic_487a3c1_2',);
        }

        // _assetic_487a3c1_3
        if ($pathinfo === '/js/487a3c1_renderer_4.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => '3',  '_format' => 'js',  '_route' => '_assetic_487a3c1_3',);
        }

        // _assetic_487a3c1_4
        if ($pathinfo === '/js/487a3c1_arbor_homepage_setup_5.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '487a3c1',  'pos' => '4',  '_format' => 'js',  '_route' => '_assetic_487a3c1_4',);
        }

        // _assetic_6d6f477
        if ($pathinfo === '/css/6d6f477.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '6d6f477',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_6d6f477',);
        }

        // _assetic_6d6f477_0
        if ($pathinfo === '/css/6d6f477_bootstrap_1.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '6d6f477',  'pos' => '0',  '_format' => 'css',  '_route' => '_assetic_6d6f477_0',);
        }

        // _assetic_6d6f477_1
        if ($pathinfo === '/css/6d6f477_style_2.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '6d6f477',  'pos' => '1',  '_format' => 'css',  '_route' => '_assetic_6d6f477_1',);
        }

        // _assetic_6d6f477_2
        if ($pathinfo === '/css/6d6f477_bootstrap-responsive_3.css') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => '6d6f477',  'pos' => '2',  '_format' => 'css',  '_route' => '_assetic_6d6f477_2',);
        }

        // _assetic_f40b08f
        if ($pathinfo === '/js/f40b08f.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_f40b08f',);
        }

        // _assetic_f40b08f_0
        if ($pathinfo === '/js/f40b08f_jquery_1.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '0',  '_format' => 'js',  '_route' => '_assetic_f40b08f_0',);
        }

        // _assetic_f40b08f_1
        if ($pathinfo === '/js/f40b08f_bootstrap-transition_2.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '1',  '_format' => 'js',  '_route' => '_assetic_f40b08f_1',);
        }

        // _assetic_f40b08f_2
        if ($pathinfo === '/js/f40b08f_bootstrap-alert_3.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '2',  '_format' => 'js',  '_route' => '_assetic_f40b08f_2',);
        }

        // _assetic_f40b08f_3
        if ($pathinfo === '/js/f40b08f_bootstrap-modal_4.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '3',  '_format' => 'js',  '_route' => '_assetic_f40b08f_3',);
        }

        // _assetic_f40b08f_4
        if ($pathinfo === '/js/f40b08f_bootstrap-dropdown_5.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '4',  '_format' => 'js',  '_route' => '_assetic_f40b08f_4',);
        }

        // _assetic_f40b08f_5
        if ($pathinfo === '/js/f40b08f_bootstrap-scrollspy_6.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '5',  '_format' => 'js',  '_route' => '_assetic_f40b08f_5',);
        }

        // _assetic_f40b08f_6
        if ($pathinfo === '/js/f40b08f_bootstrap-tab_7.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '6',  '_format' => 'js',  '_route' => '_assetic_f40b08f_6',);
        }

        // _assetic_f40b08f_7
        if ($pathinfo === '/js/f40b08f_bootstrap-tooltip_8.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '7',  '_format' => 'js',  '_route' => '_assetic_f40b08f_7',);
        }

        // _assetic_f40b08f_8
        if ($pathinfo === '/js/f40b08f_bootstrap-popover_9.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '8',  '_format' => 'js',  '_route' => '_assetic_f40b08f_8',);
        }

        // _assetic_f40b08f_9
        if ($pathinfo === '/js/f40b08f_bootstrap-button_10.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '9',  '_format' => 'js',  '_route' => '_assetic_f40b08f_9',);
        }

        // _assetic_f40b08f_10
        if ($pathinfo === '/js/f40b08f_bootstrap-collapse_11.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '10',  '_format' => 'js',  '_route' => '_assetic_f40b08f_10',);
        }

        // _assetic_f40b08f_11
        if ($pathinfo === '/js/f40b08f_bootstrap-carousel_12.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '11',  '_format' => 'js',  '_route' => '_assetic_f40b08f_11',);
        }

        // _assetic_f40b08f_12
        if ($pathinfo === '/js/f40b08f_bootstrap-typeahead_13.js') {
            return array (  '_controller' => 'assetic.controller:render',  'name' => 'f40b08f',  'pos' => '12',  '_format' => 'js',  '_route' => '_assetic_f40b08f_12',);
        }

        // _wdt
        if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?<token>[^/]+)$#s', $pathinfo, $matches)) {
            return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::toolbarAction',)), array('_route' => '_wdt'));
        }

        if (0 === strpos($pathinfo, '/_profiler')) {
            // _profiler_search
            if ($pathinfo === '/_profiler/search') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchAction',  '_route' => '_profiler_search',);
            }

            // _profiler_purge
            if ($pathinfo === '/_profiler/purge') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::purgeAction',  '_route' => '_profiler_purge',);
            }

            // _profiler_info
            if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?<about>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::infoAction',)), array('_route' => '_profiler_info'));
            }

            // _profiler_import
            if ($pathinfo === '/_profiler/import') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::importAction',  '_route' => '_profiler_import',);
            }

            // _profiler_export
            if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?<token>[^/\\.]+)\\.txt$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::exportAction',)), array('_route' => '_profiler_export'));
            }

            // _profiler_phpinfo
            if ($pathinfo === '/_profiler/phpinfo') {
                return array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::phpinfoAction',  '_route' => '_profiler_phpinfo',);
            }

            // _profiler_search_results
            if (preg_match('#^/_profiler/(?<token>[^/]+)/search/results$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::searchResultsAction',)), array('_route' => '_profiler_search_results'));
            }

            // _profiler
            if (preg_match('#^/_profiler/(?<token>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Symfony\\Bundle\\WebProfilerBundle\\Controller\\ProfilerController::panelAction',)), array('_route' => '_profiler'));
            }

            // _profiler_redirect
            if (rtrim($pathinfo, '/') === '/_profiler') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_profiler_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => '_profiler_search_results',  'token' => 'empty',  'ip' => '',  'url' => '',  'method' => '',  'limit' => '10',  '_route' => '_profiler_redirect',);
            }

        }

        if (0 === strpos($pathinfo, '/_configurator')) {
            // _configurator_home
            if (rtrim($pathinfo, '/') === '/_configurator') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_configurator_home');
                }

                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
            }

            // _configurator_step
            if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?<index>[^/]+)$#s', $pathinfo, $matches)) {
                return array_merge($this->mergeDefaults($matches, array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',)), array('_route' => '_configurator_step'));
            }

            // _configurator_final
            if ($pathinfo === '/_configurator/final') {
                return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
            }

        }

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
