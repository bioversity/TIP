<?php

/* ::base.html.twig */
class __TwigTemplate_7736273d951bd4ed5ea86fcf3266ab22 extends Twig_Template
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
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session"), "get", array(0 => "user"), "method")) {
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
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_0") : $this->env->getExtension('assets')->getAssetUrl("css/6d6f477_bootstrap_1.css");
            // line 16
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
            // asset "6d6f477_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_1") : $this->env->getExtension('assets')->getAssetUrl("css/6d6f477_style_2.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
            // asset "6d6f477_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477_2") : $this->env->getExtension('assets')->getAssetUrl("css/6d6f477_bootstrap-responsive_3.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\" rel=\"stylesheet\" type=\"text/css\">
        ";
        } else {
            // asset "6d6f477"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6d6f477") : $this->env->getExtension('assets')->getAssetUrl("css/6d6f477.css");
            echo "            <link href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
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
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_0") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_jquery_1.js");
            // line 36
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_1") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-transition_2.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_2") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-alert_3.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_3") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-modal_4.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_4") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-dropdown_5.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_5"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_5") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-scrollspy_6.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_6"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_6") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-tab_7.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_7"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_7") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-tooltip_8.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_8"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_8") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-popover_9.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_9"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_9") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-button_10.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_10"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_10") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-collapse_11.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_11"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_11") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-carousel_12.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
            // asset "f40b08f_12"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f_12") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f_bootstrap-typeahead_13.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
        ";
        } else {
            // asset "f40b08f"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_f40b08f") : $this->env->getExtension('assets')->getAssetUrl("js/f40b08f.js");
            echo "            <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
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
        return array (  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 62,  88 => 60,  86 => 59,  83 => 58,  81 => 57,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 50,  62 => 49,  59 => 48,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 10,  30 => 4,  27 => 5,);
    }
}
