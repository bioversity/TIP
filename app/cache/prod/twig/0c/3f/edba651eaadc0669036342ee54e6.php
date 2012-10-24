<?php

/* ::menuhead.html.twig */
class __TwigTemplate_0c3fedba651eaadc0669036342ee54e6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"navbar navbar-fixed-top\">
  <div class=\"navbar-inner menu_top_inner\">
    
    <div class=\"container\">
      <div id=\"tip_logo\">
        <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/TIP-logo.gif"), "html", null, true);
        echo "\" />
      </div>
      
      <a data-target=\".nav_menu_top\" data-toggle=\"collapse\" class=\"btn btn-navbar\">
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </a>
      
      <a class=\"brand\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_homepage"), "html", null, true);
        echo "\">
        <strong>T</strong>rait
        <br/>
        <strong>I</strong>nformation <br/>
        <strong>P</strong>ortal
      </a>
      <div class=\"nav-collapse collapse\">
        <ul class=\"nav\">
        </ul>
      </div>
      
      <div class=\"nav_menu_top nav-collapse collapse first_row\">  
        ";
        // line 27
        $this->env->loadTemplate("::login.html.twig")->display($context);
        // line 28
        echo "      </div>

      ";
        // line 30
        $context["currentPath"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 31
        echo "      
      <div class=\"nav_menu_top nav-collapse collapse second_row\">
        <ul class=\"nav  pull-right\">
          <li class=\"root_page ";
        // line 34
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_homepage")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_homepage"), "html", null, true);
        echo "\">Home</a>
          </li>
          <li class=\"static_page ";
        // line 37
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_about")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_about"), "html", null, true);
        echo "\">About</a>
          </li>
          <li class=\"static_page ";
        // line 40
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_contact")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_contact"), "html", null, true);
        echo "\">Contact</a>
          </li>
          <li class=\"trait_page ";
        // line 43
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_browse_trait")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_trait"), "html", null, true);
        echo "\">Trait</a>
          </li>
          <!--
          <li class=\"research_page ";
        // line 47
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_browse_landrace")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_landrace"), "html", null, true);
        echo "\">Landrace</a>
          </li>
          <li class=\"research_page ";
        // line 50
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_browse_cwr")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_cwr"), "html", null, true);
        echo "\">Crop Wild Relatives</a>
          </li>
          -->
          ";
        // line 55
        echo "          <!--
            <li class=\"dashboard_page ";
        // line 56
        if (((isset($context["currentPath"]) ? $context["currentPath"] : null) == "bioversity_ontology_dashboard")) {
            echo " active";
        }
        echo "\">
              <a href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_dashboard"), "html", null, true);
        echo "\">Dashboard</a>
            </li>
          -->
          ";
        // line 61
        echo "        </ul>
        
        
        <ul class=\"nav  pull-right\">
          <li><a href=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_database"), "html", null, true);
        echo "\">Database</a></li>
          <li><a data-toggle=\"modal\" href=\"#MenbersModal\">Members</a></li>
          <li><a data-toggle=\"modal\" href=\"#WorkshopsModal\">Workshops</a></li>
          <li><a data-toggle=\"modal\" href=\"#ProjectsModal\">Projects</a></li>
          <li><a data-toggle=\"modal\" href=\"#PublicationsModal\">Publications</a></li>
          <li><a data-toggle=\"modal\" href=\"#DataUsePolicyModal\">Data Use Policy</a></li>
          <li><a data-toggle=\"modal\" href=\"#AdvisoryBoardModal\">Advisory Board</a></li>
          <li><a data-toggle=\"modal\" href=\"#NewsArchiveModal\">News Archive</a></li>
          <li><a data-toggle=\"modal\" href=\"#GovernanceModal\">Governance</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "::menuhead.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 65,  147 => 61,  141 => 57,  135 => 56,  132 => 55,  126 => 51,  120 => 50,  115 => 48,  109 => 47,  103 => 44,  97 => 43,  75 => 37,  70 => 35,  64 => 34,  57 => 30,  53 => 28,  51 => 27,  36 => 15,  24 => 6,  23 => 5,  25 => 7,  17 => 1,  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 41,  88 => 60,  86 => 40,  83 => 58,  81 => 38,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 50,  62 => 49,  59 => 31,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 10,  30 => 4,  27 => 5,);
    }
}
