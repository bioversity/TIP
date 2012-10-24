<?php

/* ::login.html.twig */
class __TwigTemplate_b20ca1029673e4dc5b456faa87bb7fdd extends Twig_Template
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
        // line 2
        echo "
<ul id=\"login_form\" class=\"nav pull-right\">
  <li>
    <form class=\"navbar-search pull-left\">
      <input type=\"text\" placeholder=\"Search...\" data-source=\"[&quot;Sweet&quot;,&quot;Clean&quot;,&quot;Popular&quot;,&quot;HTML&quot;,&quot;CSS&quot;,&quot;Free&quot;,&quot;Graphic&quot;,&quot;Colors&quot;,&quot;Cool&quot;,&quot;Simple&quot;]\" data-items=\"4\" data-provide=\"typeahead\" class=\"search-query span3\">
    </form>
  </li>
  ";
        // line 9
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session"), "get", array(0 => "user"), "method")) {
            // line 10
            echo "    <li class=\"divider-vertical\"></li>
    <li>
      <div class=\"btn-group pull-right\">
        <a class=\"btn btn-info\" data-toggle=\"modal\" href=\"#ProfileModal\">
          <i class=\"icon-user\"></i>
          <span>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session"), "get", array(0 => "user"), "method"), "username"), "html", null, true);
            echo "</span>
        </a>
        <button class=\"btn btn-info dropdown-toggle\" data-toggle=\"dropdown\">
          <span class=\"caret\"></span>
        </button>
        <ul class=\"dropdown-menu\" style=\"width: 240px\">
          <li><a href=\"";
            // line 21
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_logout"), "html", null, true);
            echo "\">Sign Out</a></li>
        </ul>
      </div>
    </li>
  ";
        } else {
            // line 26
            echo "    <li>
      <a data-toggle=\"modal\" href=\"#RegistrationModal\">
        <span>Register</span>
      </a>
    </li>
    <li>
      <a data-toggle=\"modal\" href=\"#LoginModal\">
        <span>Login</span>
      </a>
    </li>
  ";
        }
        // line 37
        echo "<!--  <li>
    <a data-toggle=\"modal\" href=\"#SitemapModal\"><i class=\"icon-th-large\"></i></a>
  </li>-->
</ul>";
    }

    public function getTemplateName()
    {
        return "::login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 26,  44 => 21,  28 => 10,  26 => 9,  153 => 65,  147 => 61,  141 => 57,  135 => 56,  132 => 55,  126 => 51,  120 => 50,  115 => 48,  109 => 47,  103 => 44,  97 => 43,  75 => 37,  70 => 35,  64 => 34,  57 => 30,  53 => 28,  51 => 27,  36 => 15,  24 => 6,  23 => 5,  25 => 7,  17 => 2,  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 41,  88 => 60,  86 => 40,  83 => 58,  81 => 38,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 37,  62 => 49,  59 => 31,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 15,  30 => 4,  27 => 5,);
    }
}
