<?php

/* BioversityOntologyBundle:Default:contribute_data.html.twig */
class __TwigTemplate_ae5d1060e962355d5bb17afb7c1351c5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "  <div class=\"span9\">
  ";
        // line 5
        $this->env->loadTemplate("BioversityOntologyBundle:Default:credential_request.html.twig")->display($context);
        // line 6
        echo "    <h2>Contribute data</h2>
    <p>
      You are welcome to contribute data to the TIP initiative at any time. Benefits of submitting data are potential……. 
      <br/>
      The status of data contributed to TIP is defined by the Intellectual Property Guidelines …..condition to be defined…. 
      <br/>
      In case of data contribution, we need some additional information about the dataset and traits. Auxiliary information like…….. is greatly appreciated and will improve the value of your data for re-use. The information about the dataset and traits is consistent with the requirements defined by the DOC (to be drafted). 
      <br/>
      There are no special requirements for the format of data contribution. Trait data are accepted in any way as long as they are explicitly related to plant species. The preferred format is MS Excel with species information, traits and auxiliary data in columns and observations in rows. 
    </p>
    <p>
      The best way to submit data is sending them by email to (address here). 
      <br/>
      If you would like to learn more about TIP or contribute a dataset to the TIP database, please contact us! 
    </p>
    ";
        // line 21
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "get", array(0 => "user"), "method")) {
            echo "      
      <div class=\"tabbable\"> <!-- Only required for left/right tabs -->
        <ul class=\"nav nav-tabs\">
        <li class=\"active\"><a href=\"#tab1\" data-toggle=\"tab\">Step 1</a></li>
        <li><a>Step 2</a></li>
        </ul>
        <div class=\"tab-content\">
          <div class=\"tab-pane active\" id=\"tab1\">
            <form>
              <input id=\"datasets\" class=\"input-large\" type=\"file\" />
              <input class=\"btn\" type=\"submit\" value=\"submit\" />
            </form>
          </div>
          <div class=\"tab-pane\" id=\"tab2\">
          </div>
        </div>
      </div>
    ";
        }
        // line 39
        echo "  </div>
  ";
        // line 40
        $this->env->loadTemplate("BioversityOntologyBundle:Default:data_menu.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:contribute_data.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 21,  241 => 59,  237 => 38,  146 => 21,  139 => 18,  108 => 11,  105 => 10,  88 => 60,  21 => 1,  54 => 46,  38 => 8,  305 => 102,  299 => 98,  296 => 97,  293 => 96,  291 => 95,  286 => 92,  280 => 88,  277 => 87,  274 => 86,  272 => 85,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 75,  224 => 74,  219 => 72,  215 => 71,  208 => 68,  202 => 65,  198 => 64,  181 => 60,  164 => 59,  124 => 48,  107 => 36,  80 => 24,  75 => 40,  36 => 6,  156 => 58,  148 => 52,  142 => 51,  140 => 50,  127 => 49,  123 => 44,  115 => 42,  110 => 37,  85 => 28,  65 => 50,  59 => 48,  45 => 9,  89 => 20,  82 => 19,  42 => 39,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 79,  189 => 63,  187 => 62,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 53,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 36,  98 => 34,  76 => 54,  73 => 23,  69 => 18,  32 => 5,  103 => 24,  91 => 20,  74 => 53,  70 => 29,  66 => 12,  56 => 47,  25 => 4,  22 => 2,  23 => 3,  17 => 1,  92 => 62,  86 => 59,  77 => 17,  57 => 22,  29 => 4,  24 => 6,  19 => 2,  68 => 51,  61 => 24,  44 => 7,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 20,  137 => 45,  129 => 42,  121 => 41,  118 => 40,  113 => 16,  104 => 35,  99 => 5,  94 => 63,  81 => 57,  78 => 34,  72 => 39,  64 => 15,  53 => 15,  50 => 14,  48 => 43,  41 => 7,  39 => 9,  35 => 5,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 54,  151 => 36,  149 => 53,  141 => 54,  136 => 47,  134 => 50,  131 => 51,  128 => 47,  120 => 37,  117 => 36,  114 => 35,  109 => 38,  106 => 37,  100 => 30,  96 => 30,  93 => 33,  90 => 29,  87 => 19,  83 => 58,  79 => 25,  71 => 26,  62 => 20,  58 => 19,  55 => 11,  52 => 10,  49 => 14,  46 => 13,  43 => 8,  40 => 20,  37 => 10,  34 => 6,  31 => 4,  28 => 7,);
    }
}
