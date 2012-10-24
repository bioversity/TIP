<?php

/* ::base.html.twig */
class __TwigTemplate_24217625acb6f3c01e9959c0bfc556bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 19
        echo "    
    ";
        // line 20
        $this->displayBlock('javascripts', $context, $blocks);
        // line 39
        echo "    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
  </head>
  <body class=\"hasGoogleVoiceExt\">
    ";
        // line 46
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "get", array(0 => "user"), "method")) {
            // line 47
            echo "      ";
            $this->env->loadTemplate("::form_edit_profile.html.twig")->display($context);
            // line 48
            echo "    ";
        } else {
            // line 49
            echo "      ";
            $this->env->loadTemplate("::form_registration.html.twig")->display($context);
            // line 50
            echo "      ";
            $this->env->loadTemplate("::form_login.html.twig")->display($context);
            // line 51
            echo "    ";
        }
        // line 52
        echo "    
    ";
        // line 53
        $this->env->loadTemplate("::menuhead.html.twig")->display($context);
        // line 54
        echo "    
    <div class=\"container\">
      
      ";
        // line 57
        $this->env->loadTemplate("::error.html.twig")->display($context);
        // line 58
        echo "    
      ";
        // line 59
        $this->displayBlock('body', $context, $blocks);
        // line 60
        echo "      
    </div>
    ";
        // line 62
        $this->env->loadTemplate("::footer.html.twig")->display($context);
        // line 63
        echo "  </body>
</html>";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Bioversity Internation TIP";
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "        ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "6d6f477_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/6d6f477_bootstrap_1.css");
            // line 16
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
            // asset "6d6f477_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/6d6f477_style_2.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
            // asset "6d6f477_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/6d6f477_bootstrap-responsive_3.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
        } else {
            // asset "6d6f477"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/6d6f477.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
        }
        unset($context["asset_url"]);
        // line 18
        echo "    ";
    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        // line 21
        echo "        ";
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "f40b08f_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_jquery_1.js");
            // line 36
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-transition_2.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-alert_3.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_3") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-modal_4.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_4") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-dropdown_5.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_5") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-scrollspy_6.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_6"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_6") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-tab_7.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_7"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_7") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-tooltip_8.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_8"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_8") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-popover_9.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_9"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_9") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-button_10.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_10"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_10") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-collapse_11.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_11"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_11") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-carousel_12.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_12"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_12") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f_bootstrap-typeahead_13.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
        } else {
            // asset "f40b08f"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/f40b08f.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "asset_url"), "html", null, true);
            echo "\"></script>
        ";
        }
        unset($context["asset_url"]);
        // line 38
        echo "    ";
    }

    // line 59
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  241 => 59,  237 => 38,  146 => 21,  139 => 18,  108 => 11,  105 => 10,  88 => 60,  21 => 1,  54 => 46,  38 => 9,  305 => 102,  299 => 98,  296 => 97,  293 => 96,  291 => 95,  286 => 92,  280 => 88,  277 => 87,  274 => 86,  272 => 85,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 75,  224 => 74,  219 => 72,  215 => 71,  208 => 68,  202 => 65,  198 => 64,  181 => 60,  164 => 59,  124 => 48,  107 => 36,  80 => 24,  75 => 21,  36 => 6,  156 => 58,  148 => 52,  142 => 51,  140 => 50,  127 => 49,  123 => 44,  115 => 42,  110 => 37,  85 => 28,  65 => 50,  59 => 48,  45 => 9,  89 => 20,  82 => 19,  42 => 39,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 79,  189 => 63,  187 => 62,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 53,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 36,  98 => 34,  76 => 54,  73 => 23,  69 => 18,  32 => 5,  103 => 24,  91 => 20,  74 => 53,  70 => 29,  66 => 12,  56 => 47,  25 => 4,  22 => 2,  23 => 3,  17 => 1,  92 => 62,  86 => 59,  77 => 17,  57 => 22,  29 => 4,  24 => 6,  19 => 2,  68 => 51,  61 => 24,  44 => 7,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 20,  137 => 45,  129 => 42,  121 => 41,  118 => 40,  113 => 16,  104 => 35,  99 => 5,  94 => 63,  81 => 57,  78 => 34,  72 => 16,  64 => 15,  53 => 15,  50 => 15,  48 => 43,  41 => 7,  39 => 9,  35 => 10,  33 => 5,  30 => 4,  27 => 5,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 54,  151 => 36,  149 => 53,  141 => 54,  136 => 47,  134 => 50,  131 => 51,  128 => 47,  120 => 37,  117 => 36,  114 => 35,  109 => 38,  106 => 37,  100 => 30,  96 => 30,  93 => 33,  90 => 29,  87 => 19,  83 => 58,  79 => 25,  71 => 52,  62 => 49,  58 => 12,  55 => 11,  52 => 10,  49 => 14,  46 => 14,  43 => 8,  40 => 20,  37 => 19,  34 => 5,  31 => 4,  28 => 7,);
    }
}
