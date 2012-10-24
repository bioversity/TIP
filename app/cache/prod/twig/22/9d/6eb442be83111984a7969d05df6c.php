<?php

/* BioversityOntologyBundle:Default:left_side.html.twig */
class __TwigTemplate_229d6eb442be83111984a7969d05df6c extends Twig_Template
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
        echo "<div class=\"span2\">
  <div id=\"logo_conteiner\" class=\"sidewell\">
    <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/TIP-logo.gif"), "html", null, true);
        echo "\" />
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:left_side.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 3,  17 => 1,  32 => 5,  29 => 4,  26 => 3,);
    }
}
