<?php

/* ::footer.html.twig */
class __TwigTemplate_ed1cf36711f6fc0644f8f9649eb07e61 extends Twig_Template
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
        $this->env->loadTemplate("::footerModal.html.twig")->display($context);
        // line 2
        echo "
<footer class=\"navbar navbar-fixed-bottom\">
  <div class=\"navbar-inner menu_top_inner\">
    <div class=\"container\">
      <a data-target=\"#footer_menu\" data-toggle=\"collapse\" class=\"btn btn-navbar\">
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </a>
        
      <div id=\"footer_menu\" class=\"nav-collapse collapse\" style=\"height: 0px;\">
        <p>All content on the database is protected by the <a target=\"_blank\" href=\"http://eurisco.ecpgr.org/about/data_policy/terms_of_use.html\">Term of Use</a></p>
        <table>
          <tbody>
            <tr>
              <td width=\"10%\" valign=\"top\">
                <a target=\"_blank\" rel=\"license\" href=\"http://creativecommons.org/licenses/by-nc-nd/3.0/\">
                  <img alt=\"Creative Commons Licence\" style=\"border-width: 0pt;\" src=\"http://creativecommons.org/images/public/somerights20.png\">
                </a>
              </td>
              <td width=\"90%\">
                <p>
                  <small>All content on this website is protected by a Creative Commons Attribution Non-Commercial No Derivatives license. This license allows others to download works from this website and share them with others as long as they mention and link back to this website, but they can't change them in any way or use them commercially.</small>
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</footer>";
    }

    public function getTemplateName()
    {
        return "::footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,  52 => 26,  44 => 21,  28 => 10,  26 => 9,  153 => 65,  147 => 61,  141 => 57,  135 => 56,  132 => 55,  126 => 51,  120 => 50,  115 => 48,  109 => 47,  103 => 44,  97 => 43,  75 => 37,  70 => 35,  64 => 34,  57 => 30,  53 => 28,  51 => 27,  36 => 15,  24 => 5,  23 => 5,  25 => 7,  17 => 1,  241 => 59,  237 => 38,  151 => 36,  146 => 21,  143 => 20,  139 => 18,  113 => 16,  108 => 11,  105 => 10,  99 => 5,  94 => 63,  92 => 41,  88 => 60,  86 => 40,  83 => 58,  81 => 38,  76 => 54,  74 => 53,  71 => 52,  68 => 51,  65 => 37,  62 => 49,  59 => 31,  56 => 47,  54 => 46,  48 => 43,  42 => 39,  40 => 20,  37 => 19,  21 => 1,  79 => 16,  39 => 12,  35 => 15,  30 => 4,  27 => 5,);
    }
}
