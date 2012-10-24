<?php

/* BioversityOntologyBundle:Default:data_menu.html.twig */
class __TwigTemplate_b3666cea92254e017213f168c2b9752b extends Twig_Template
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
        echo "<div class=\"span2 sidewell\">
  <div class=\"wellfb\">
    <ul id=\"data_menu\" class=\"nav nav-pills nav-stacked\">
      ";
        // line 4
        $context["currentPath"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 5
        echo "      <li ";
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_datasets")) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_datasets"), "html", null, true);
        echo "\">Datasets</a></li>
      <li ";
        // line 6
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_data_search")) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_data_search"), "html", null, true);
        echo "\">Data Search</a></li>
      <li ";
        // line 7
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_download_data")) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_download_data"), "html", null, true);
        echo "\">Download Data</a></li>
      <li ";
        // line 8
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_request_data")) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_request_data"), "html", null, true);
        echo "\">Request Data</a></li>
      <li ";
        // line 9
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_contribute_data")) {
            echo " class=\"active\" ";
        }
        echo "><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_contribute_data"), "html", null, true);
        echo "\">Contribute Data</a></li>
    </ul>
  </div>
  <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/PGR_Secure.gif"), "html", null, true);
        echo "\" />
</div>";
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:data_menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 12,  75 => 40,  51 => 21,  241 => 59,  146 => 21,  108 => 11,  88 => 60,  21 => 1,  54 => 46,  38 => 8,  405 => 145,  399 => 144,  394 => 141,  386 => 138,  382 => 136,  378 => 134,  369 => 132,  365 => 131,  362 => 130,  360 => 129,  355 => 127,  352 => 126,  348 => 125,  338 => 117,  334 => 115,  332 => 114,  327 => 113,  323 => 112,  318 => 109,  312 => 105,  309 => 104,  306 => 103,  304 => 102,  299 => 99,  293 => 95,  290 => 94,  287 => 93,  285 => 92,  280 => 89,  266 => 88,  262 => 86,  247 => 84,  239 => 82,  237 => 38,  232 => 79,  228 => 78,  221 => 75,  215 => 72,  211 => 71,  202 => 70,  200 => 69,  177 => 66,  174 => 65,  168 => 61,  166 => 60,  144 => 58,  140 => 56,  126 => 50,  123 => 44,  105 => 10,  36 => 6,  142 => 53,  139 => 18,  133 => 47,  124 => 45,  107 => 41,  101 => 37,  65 => 50,  59 => 48,  45 => 9,  89 => 20,  82 => 28,  42 => 39,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 67,  192 => 79,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 55,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 42,  102 => 36,  98 => 34,  76 => 54,  73 => 23,  69 => 17,  32 => 5,  103 => 24,  91 => 28,  74 => 53,  70 => 29,  66 => 12,  56 => 47,  25 => 4,  22 => 4,  23 => 3,  17 => 1,  92 => 62,  86 => 59,  77 => 17,  57 => 9,  29 => 4,  24 => 5,  19 => 2,  68 => 51,  61 => 24,  44 => 7,  20 => 2,  161 => 59,  153 => 58,  150 => 49,  147 => 48,  143 => 20,  137 => 55,  129 => 51,  121 => 41,  118 => 40,  113 => 16,  104 => 36,  99 => 5,  94 => 63,  81 => 57,  78 => 34,  72 => 39,  64 => 15,  53 => 15,  50 => 14,  48 => 43,  41 => 7,  39 => 12,  35 => 5,  33 => 6,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 60,  151 => 36,  149 => 53,  141 => 54,  136 => 51,  134 => 50,  131 => 43,  128 => 47,  120 => 43,  117 => 42,  114 => 35,  109 => 37,  106 => 37,  100 => 30,  96 => 31,  93 => 34,  90 => 33,  87 => 19,  83 => 58,  79 => 16,  71 => 26,  62 => 20,  58 => 19,  55 => 11,  52 => 10,  49 => 8,  46 => 13,  43 => 8,  40 => 20,  37 => 10,  34 => 6,  31 => 4,  28 => 7,);
    }
}
