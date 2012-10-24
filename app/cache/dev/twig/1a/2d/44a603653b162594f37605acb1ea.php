<?php

/* BioversityOntologyBundle:Default:contact.html.twig */
class __TwigTemplate_1a2d44a603653b162594f37605acb1ea extends Twig_Template
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
        echo "  ";
        $this->env->loadTemplate("BioversityOntologyBundle:Default:left_side.html.twig")->display($context);
        // line 5
        echo "  <div id=\"contact_page\" class=\"span9\">
      <h3>Contact</h3>
      <ul class=\"thumbnails\">
        <li>
          <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_7.jpg"), "html", null, true);
        echo "\" />
          <label> Project Coordination</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_6.jpg"), "html", null, true);
        echo "\" />
          <label> Project Coordination</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_5.jpg"), "html", null, true);
        echo "\" />
          <label> Content and Science</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_4.jpg"), "html", null, true);
        echo "\" />
          <label> Database Management</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_3.jpg"), "html", null, true);
        echo "\" />
          <label> Technical Issues</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_2.jpg"), "html", null, true);
        echo "\" />
          <label> Database Management</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
        <li>
          <img src=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/avatar_1.jpg"), "html", null, true);
        echo "\" />
          <label> Web Administration</label>
          <p><i class=\"icon-user\"></i>Firstname Lastname <i class=\"icon-envelope\"></i><a href=\"#mailto\" title=\"send email\">email@apress.com</a></p>
        </li>
      </ul>
    <hr>
      <h3>Feedback</h3>
      <p>
        If you've found or this web site useful or would like to send any comment on the TIP initiative please e-mail us or provide feedback in the forum below. We'd like to know how the TIP website is being used.<br/>
        If you have cited the TIP initiative in a publication, please send us that reference. This will help to document that the TIP initiative has value, and will help if / when we look for apitional funding.<br/>
        Thank you.
      </p>
    <hr>
      <h3>Forum</h3>
      <p><a href=\"#\" title=\"TipForum\">Here</a> you can participate in the discussion (Registration required).</p>
  </div>
";
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:contact.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 19,  38 => 9,  405 => 145,  399 => 144,  394 => 141,  386 => 138,  382 => 136,  378 => 134,  369 => 132,  365 => 131,  362 => 130,  360 => 129,  355 => 127,  352 => 126,  348 => 125,  338 => 117,  334 => 115,  332 => 114,  327 => 113,  323 => 112,  318 => 109,  312 => 105,  309 => 104,  306 => 103,  304 => 102,  299 => 99,  293 => 95,  290 => 94,  287 => 93,  285 => 92,  280 => 89,  266 => 88,  262 => 86,  247 => 84,  239 => 82,  237 => 81,  232 => 79,  228 => 78,  221 => 75,  215 => 72,  211 => 71,  202 => 70,  200 => 69,  177 => 66,  174 => 65,  168 => 61,  166 => 60,  144 => 58,  140 => 56,  126 => 50,  123 => 44,  105 => 36,  36 => 6,  142 => 53,  139 => 51,  133 => 47,  124 => 45,  107 => 41,  101 => 37,  65 => 15,  59 => 13,  45 => 9,  89 => 20,  82 => 28,  42 => 12,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 67,  192 => 79,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 55,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 42,  102 => 36,  98 => 34,  76 => 21,  73 => 23,  69 => 17,  32 => 5,  103 => 24,  91 => 28,  74 => 16,  70 => 29,  66 => 12,  56 => 22,  25 => 4,  22 => 2,  23 => 3,  17 => 1,  92 => 39,  86 => 39,  77 => 17,  57 => 22,  29 => 4,  24 => 6,  19 => 2,  68 => 20,  61 => 24,  44 => 7,  20 => 2,  161 => 59,  153 => 58,  150 => 49,  147 => 48,  143 => 46,  137 => 55,  129 => 51,  121 => 41,  118 => 40,  113 => 39,  104 => 36,  99 => 32,  94 => 21,  81 => 18,  78 => 34,  72 => 16,  64 => 15,  53 => 15,  50 => 15,  48 => 10,  41 => 7,  39 => 9,  35 => 8,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 60,  151 => 54,  149 => 53,  141 => 54,  136 => 51,  134 => 50,  131 => 43,  128 => 47,  120 => 43,  117 => 42,  114 => 35,  109 => 37,  106 => 37,  100 => 30,  96 => 31,  93 => 34,  90 => 33,  87 => 19,  83 => 25,  79 => 40,  71 => 19,  62 => 24,  58 => 23,  55 => 11,  52 => 10,  49 => 14,  46 => 14,  43 => 8,  40 => 7,  37 => 9,  34 => 5,  31 => 4,  28 => 7,);
    }
}
