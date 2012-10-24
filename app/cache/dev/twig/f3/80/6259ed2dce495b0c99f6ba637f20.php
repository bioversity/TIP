<?php

/* AcmeDemoBundle:Demo:hello.html.twig */
class __TwigTemplate_f3806259ed2dce495b0c99f6ba637f20 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("AcmeDemoBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 9
        $context["code"] = $this->env->getExtension('demo')->getCode($this);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, ("Hello " . $this->getContext($context, "name")), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <h1>Hello ";
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "!</h1>
";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Demo:hello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 39,  95 => 45,  84 => 39,  80 => 37,  63 => 23,  47 => 10,  67 => 12,  75 => 27,  51 => 11,  241 => 59,  146 => 21,  108 => 11,  88 => 60,  21 => 1,  54 => 46,  38 => 6,  405 => 145,  399 => 144,  394 => 141,  386 => 138,  382 => 136,  378 => 134,  369 => 132,  365 => 131,  362 => 130,  360 => 129,  355 => 127,  352 => 126,  348 => 125,  338 => 117,  334 => 115,  332 => 114,  327 => 113,  323 => 112,  318 => 109,  312 => 105,  309 => 104,  306 => 103,  304 => 102,  299 => 99,  293 => 95,  290 => 94,  287 => 93,  285 => 92,  280 => 89,  266 => 88,  262 => 86,  247 => 84,  239 => 82,  237 => 38,  232 => 79,  228 => 78,  221 => 75,  215 => 72,  211 => 71,  202 => 70,  200 => 69,  177 => 66,  174 => 65,  168 => 61,  166 => 60,  144 => 58,  140 => 56,  126 => 50,  123 => 44,  105 => 10,  36 => 6,  142 => 53,  139 => 18,  133 => 47,  124 => 45,  107 => 5,  101 => 37,  65 => 50,  59 => 22,  45 => 15,  89 => 20,  82 => 28,  42 => 39,  26 => 3,  223 => 96,  214 => 90,  210 => 88,  203 => 84,  199 => 83,  194 => 67,  192 => 79,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 67,  157 => 61,  152 => 59,  145 => 55,  130 => 48,  125 => 46,  119 => 30,  116 => 29,  112 => 42,  102 => 36,  98 => 34,  76 => 54,  73 => 23,  69 => 17,  32 => 5,  103 => 24,  91 => 28,  74 => 53,  70 => 29,  66 => 24,  56 => 17,  25 => 4,  22 => 4,  23 => 29,  17 => 1,  92 => 44,  86 => 41,  77 => 17,  57 => 13,  29 => 3,  24 => 9,  19 => 2,  68 => 51,  61 => 24,  44 => 8,  20 => 2,  161 => 59,  153 => 58,  150 => 49,  147 => 48,  143 => 20,  137 => 55,  129 => 51,  121 => 33,  118 => 40,  113 => 28,  104 => 36,  99 => 5,  94 => 63,  81 => 57,  78 => 28,  72 => 39,  64 => 15,  53 => 15,  50 => 10,  48 => 43,  41 => 7,  39 => 10,  35 => 5,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 58,  160 => 57,  155 => 60,  151 => 36,  149 => 53,  141 => 40,  136 => 51,  134 => 50,  131 => 31,  128 => 30,  120 => 43,  117 => 42,  114 => 35,  109 => 37,  106 => 37,  100 => 47,  96 => 31,  93 => 34,  90 => 43,  87 => 19,  83 => 58,  79 => 16,  71 => 26,  62 => 20,  58 => 19,  55 => 12,  52 => 10,  49 => 21,  46 => 9,  43 => 8,  40 => 7,  37 => 10,  34 => 5,  31 => 4,  28 => 3,);
    }
}
