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
        return array (  54 => 19,  38 => 9,  305 => 102,  299 => 98,  296 => 97,  293 => 96,  291 => 95,  286 => 92,  280 => 88,  277 => 87,  274 => 86,  272 => 85,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 75,  224 => 74,  219 => 72,  215 => 71,  208 => 68,  202 => 65,  198 => 64,  181 => 60,  164 => 59,  124 => 48,  107 => 36,  80 => 24,  75 => 21,  36 => 6,  156 => 58,  148 => 52,  142 => 51,  140 => 50,  127 => 49,  123 => 44,  115 => 42,  110 => 37,  85 => 28,  65 => 19,  59 => 16,  45 => 9,  89 => 20,  82 => 19,  42 => 12,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 79,  189 => 63,  187 => 62,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 53,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 36,  98 => 34,  76 => 24,  73 => 23,  69 => 18,  32 => 5,  103 => 24,  91 => 20,  74 => 16,  70 => 29,  66 => 12,  56 => 22,  25 => 4,  22 => 2,  23 => 3,  17 => 1,  92 => 29,  86 => 39,  77 => 17,  57 => 22,  29 => 4,  24 => 6,  19 => 2,  68 => 20,  61 => 24,  44 => 7,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 46,  137 => 45,  129 => 42,  121 => 41,  118 => 40,  113 => 43,  104 => 35,  99 => 33,  94 => 21,  81 => 18,  78 => 34,  72 => 16,  64 => 15,  53 => 15,  50 => 15,  48 => 10,  41 => 7,  39 => 9,  35 => 8,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 54,  151 => 54,  149 => 53,  141 => 54,  136 => 47,  134 => 50,  131 => 51,  128 => 47,  120 => 37,  117 => 36,  114 => 35,  109 => 38,  106 => 37,  100 => 30,  96 => 30,  93 => 33,  90 => 29,  87 => 19,  83 => 25,  79 => 25,  71 => 19,  62 => 24,  58 => 12,  55 => 11,  52 => 10,  49 => 14,  46 => 14,  43 => 8,  40 => 7,  37 => 9,  34 => 5,  31 => 4,  28 => 7,);
    }
}
