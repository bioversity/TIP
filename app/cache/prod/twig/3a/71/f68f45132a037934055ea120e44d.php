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
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_0") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1_arbor_1.js");
            // line 12
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_1") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1_arbor-tween_2.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_2") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1_graphics_3.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_3") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1_renderer_4.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
    ";
            // asset "487a3c1_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1_4") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1_arbor_homepage_setup_5.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
            echo "\"></script>
    ";
        } else {
            // asset "487a3c1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_487a3c1") : $this->env->getExtension('assets')->getAssetUrl("js/487a3c1.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : null), "html", null, true);
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
        return array (  79 => 16,  39 => 12,  35 => 5,  30 => 4,  27 => 3,);
    }
}
