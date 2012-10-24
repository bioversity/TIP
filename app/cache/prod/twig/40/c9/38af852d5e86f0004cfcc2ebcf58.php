<?php

/* ::form_registration.html.twig */
class __TwigTemplate_40c938af852d5e86f0004cfcc2ebcf58 extends Twig_Template
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
        echo "

<!-- ------------------------------------------------------------------------- --
-- MODAL REGISTRATION\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t   --
-- ------------------------------------------------------------------------- -->
<div class=\"modal hide fade\" id=\"RegistrationModal\">
  <form class=\"form-horizontal\" data-bind=\"submit: userProfileSubmit\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_user_registration"), "html", null, true);
        echo "\" method=\"post\">
    <div class=\"modal-header\">
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        <h3>User Registration</h3>
    </div>

    <div class=\"modal-body\">
      <div class=\"control-group\">
        <label class=\"control-label\" for=\"username\">Email</label>
        <div class=\"controls\">
          <input required
                 class=\"input-xlarge\"
                 type=\"text\"
                 id=\"userName\"
                 name=\"username\"
                 placeholder=\"email@exemple.com\"/>
        </div>
      </div>
      <div class=\"control-group\">
          <label class=\"control-label\" for=\"password\">Password</label>
          <div class=\"controls\">
              <input required
                     class=\"input-xlarge\"
                     type=\"password\"
                     id=\"userPass\"
                     name=\"password\"
                     placeholder=\"min 6 letter\"/>
          </div>
      </div>
    
      <p>
        <small>
          Registration does not make you a member of TIP, but allows you to download data and access to certain parts of the TIP website.
          <br/>
          A way to become a member of TIP is to submit data.
          <br/>
          You have to provide a valid email address. Your password will be sent to this email address.
          <br/>
          When asked for credentials, enter your full email address (e.g.abc@mail.com) as user name. 
        </small>
      </p>
    </div>

    <div class=\"modal-footer\">
      <a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cancel</a>
      <button class=\"btn-small btn-primary\" type=\"submit\">
        <i class=\"icon-user icon-white\"></i>Register
      </button>
    </div>
    
  </form>
</div>
<!--/.ProfileModal -->";
    }

    public function getTemplateName()
    {
        return "::form_registration.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 7,  17 => 1,  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 62,  88 => 60,  86 => 59,  83 => 58,  81 => 57,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 50,  62 => 49,  59 => 48,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 10,  30 => 4,  27 => 5,);
    }
}
