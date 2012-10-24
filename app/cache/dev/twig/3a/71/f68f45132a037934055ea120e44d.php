<?php

/* BioversityOntologyBundle:Default:index.html.twig */
class __TwigTemplate_3a71f68f45132a037934055ea120e44d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'javascripts' => array($this, 'block_javascripts'),
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
    public function block_javascripts($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
    ";
        // line 5
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "487a3c1_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1_arbor_1.js");
            // line 12
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1_arbor-tween_2.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1_graphics_3.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_3") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1_renderer_4.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_4") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1_arbor_homepage_setup_5.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
        } else {
            // asset "487a3c1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/487a3c1.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
    ";
        }
        unset($context["asset_url"]);
    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        echo "  
  
    <ul class=\"thumbnails\">
      <li class=\"span5\">
        <h3>Plant Trait diversity – Crop Wild Relatives – Landraces</h3>
        <p>TIP is a network of European CWR and Landraces Maecenas condimentum tincidunt fermentum. Sed accumsan erat ut magna cursus quis malesuada elit accumsan. Nulla ac nulla nunc, ut fermentum metus. Nam elementum nisi quis mauris placerat nec aliquam lacus tempor. Ut massa erat, porttitor at tempus at, fermentum vel mi. Phasellus vulputate massa eget tellus vulputate sodales. Aliquam erat volutpat. Aliquam erat volutpat. Sed risus ipsum, viverra at malesuada at, dictum non turpis. Duis sed metus id massa pretium sollicitudin. Sed venenatis congue leo et molestie.</p>
        <h3>Main objectives</h3>
        <ul>
          <li>Provide an European documentation of plant traits </li>
          <li>Promote trait use for breeding and biodiversity science </li>
          <li>Support the design of trait models for use</li>
          <li>Provide national inventory information on CWR and landraces</li>
          <li>Promote conservation plans and strategies</li>
          <li>Current state of data warehouse and network</li>
          <li>X? trait records for about 5000 plant species</li>
          <li>400 collaborators from 380 institutes/organizations</li>
          <li>XXX scientific projects requesting plant trait data from TIP</li>
          <li>200 National inventories</li>
          <li>50 conservation strategies in place</li>
        </ul>
      </li>
      <li class=\"span7\">
        <canvas height=\"600\" width=\"670px\" id=\"arbor_homepage\"></canvas>
      </li>
    </ul>
";
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 21,  241 => 59,  237 => 38,  146 => 21,  139 => 18,  108 => 11,  105 => 10,  88 => 60,  21 => 1,  54 => 46,  38 => 8,  305 => 102,  299 => 98,  296 => 97,  293 => 96,  291 => 95,  286 => 92,  280 => 88,  277 => 87,  274 => 86,  272 => 85,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 75,  224 => 74,  219 => 72,  215 => 71,  208 => 68,  202 => 65,  198 => 64,  181 => 60,  164 => 59,  124 => 48,  107 => 36,  80 => 24,  75 => 40,  36 => 6,  156 => 58,  148 => 52,  142 => 51,  140 => 50,  127 => 49,  123 => 44,  115 => 42,  110 => 37,  85 => 28,  65 => 50,  59 => 48,  45 => 9,  89 => 20,  82 => 19,  42 => 39,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 79,  189 => 63,  187 => 62,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 53,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 36,  98 => 34,  76 => 54,  73 => 23,  69 => 18,  32 => 5,  103 => 24,  91 => 20,  74 => 53,  70 => 29,  66 => 12,  56 => 47,  25 => 4,  22 => 2,  23 => 3,  17 => 1,  92 => 62,  86 => 59,  77 => 17,  57 => 22,  29 => 4,  24 => 6,  19 => 2,  68 => 51,  61 => 24,  44 => 7,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 20,  137 => 45,  129 => 42,  121 => 41,  118 => 40,  113 => 16,  104 => 35,  99 => 5,  94 => 63,  81 => 57,  78 => 34,  72 => 39,  64 => 15,  53 => 15,  50 => 14,  48 => 43,  41 => 7,  39 => 12,  35 => 5,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 54,  151 => 36,  149 => 53,  141 => 54,  136 => 47,  134 => 50,  131 => 51,  128 => 47,  120 => 37,  117 => 36,  114 => 35,  109 => 38,  106 => 37,  100 => 30,  96 => 30,  93 => 33,  90 => 29,  87 => 19,  83 => 58,  79 => 16,  71 => 26,  62 => 20,  58 => 19,  55 => 11,  52 => 10,  49 => 14,  46 => 13,  43 => 8,  40 => 20,  37 => 10,  34 => 6,  31 => 4,  28 => 7,);
    }
}
