<?php

/* ::form_login.html.twig */
class __TwigTemplate_86de620e76b15c6a4f15ef96d333d6e0 extends Twig_Template
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
        echo "<!-- ------------------------------------------------------------------------- --
  -- MODAL LOGIN\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   --
  -- ------------------------------------------------------------------------- -->
<div class=\"modal hide fade\" id=\"LoginModal\">
  <form class=\"well form-inline\" action=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_user_login"), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"modal-header\">
      <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      <h3>Login</h3>
    </div>

    <div class=\"modal-body\">
      <div class=\"input-prepend\">
        <span class=\"add-on\">
          <i class=\"icon-envelope\"></i>
        </span>
        <input name=\"username\" required class=\"span2\" type=\"text\" placeholder=\"Email\" \\>
      </div>
      <div class=\"input-prepend\">
        <span class=\"add-on\">
          <i class=\"icon-lock\"></i>
        </span>
        <input name=\"password\" required class=\"span2\" type=\"password\" placeholder=\"Password\">
      </div>
    </div>

    <div class=\"modal-footer\">
      <a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Close</a>
      <button class=\"btn-small btn-primary\" type=\"submit\">
        <i class=\"icon-user icon-white\"></i>Sign in
      </button>
    </div>
  </form>
</div><!--/.LoginModal -->";
    }

    public function getTemplateName()
    {
        return "::form_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 5,  25 => 7,  17 => 1,  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 62,  88 => 60,  86 => 59,  83 => 58,  81 => 57,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 50,  62 => 49,  59 => 48,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 10,  30 => 4,  27 => 5,);
    }
}
