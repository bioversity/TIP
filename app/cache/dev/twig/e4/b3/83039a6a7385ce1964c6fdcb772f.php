<?php

/* WebProfilerBundle:Collector:exception.html.twig */
class __TwigTemplate_e4b383039a6a7385ce1964c6fdcb772f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/css/exception.css"), "html", null, true);
        echo "\" />
    ";
        // line 5
        $this->displayParentBlock("head", $context, $blocks);
        echo "
";
    }

    // line 8
    public function block_menu($context, array $blocks = array())
    {
        // line 9
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/exception.png"), "html", null, true);
        echo "\" alt=\"Exception\" /></span>
    <strong>Exception</strong>
    <span class=\"count\">
        ";
        // line 13
        if ($this->getAttribute($this->getContext($context, "collector"), "hasexception")) {
            // line 14
            echo "            <span>1</span>
        ";
        }
        // line 16
        echo "    </span>
</span>
";
    }

    // line 20
    public function block_panel($context, array $blocks = array())
    {
        // line 21
        echo "    <h2>Exception</h2>

    ";
        // line 23
        if ((!$this->getAttribute($this->getContext($context, "collector"), "hasexception"))) {
            // line 24
            echo "        <p>
            <em>No exception was thrown and uncaught during the request.</em>
        </p>
    ";
        } else {
            // line 28
            echo "        ";
            echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Exception:show", array("exception" => $this->getAttribute($this->getContext($context, "collector"), "exception"), "format" => "html"), array());
            // line 29
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  183 => 68,  165 => 64,  162 => 63,  132 => 54,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  358 => 152,  350 => 149,  342 => 147,  340 => 146,  337 => 145,  328 => 140,  325 => 139,  278 => 114,  273 => 111,  271 => 110,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  229 => 88,  224 => 86,  219 => 83,  213 => 79,  207 => 77,  191 => 68,  186 => 69,  181 => 63,  175 => 59,  172 => 67,  167 => 56,  354 => 163,  345 => 160,  341 => 159,  333 => 157,  331 => 141,  321 => 149,  314 => 145,  307 => 141,  300 => 137,  286 => 129,  279 => 125,  272 => 121,  257 => 109,  243 => 96,  236 => 97,  226 => 87,  212 => 82,  209 => 81,  204 => 78,  201 => 77,  196 => 74,  190 => 72,  180 => 69,  156 => 56,  788 => 469,  785 => 468,  774 => 466,  770 => 465,  766 => 463,  753 => 462,  727 => 457,  724 => 456,  705 => 454,  688 => 453,  684 => 451,  680 => 450,  676 => 449,  672 => 448,  668 => 447,  664 => 446,  661 => 445,  659 => 444,  642 => 443,  631 => 442,  616 => 437,  611 => 435,  607 => 434,  604 => 433,  602 => 432,  588 => 431,  556 => 401,  538 => 398,  521 => 397,  518 => 396,  516 => 395,  511 => 393,  506 => 391,  250 => 100,  205 => 76,  188 => 67,  179 => 87,  171 => 85,  164 => 82,  159 => 80,  154 => 77,  148 => 75,  110 => 52,  85 => 34,  60 => 16,  115 => 44,  111 => 40,  138 => 42,  95 => 23,  84 => 29,  80 => 19,  63 => 23,  47 => 13,  67 => 20,  75 => 24,  51 => 11,  241 => 59,  146 => 46,  108 => 42,  88 => 41,  21 => 1,  54 => 13,  38 => 6,  405 => 145,  399 => 144,  394 => 141,  386 => 160,  382 => 136,  378 => 134,  369 => 132,  365 => 131,  362 => 130,  360 => 153,  355 => 151,  352 => 150,  348 => 125,  338 => 158,  334 => 115,  332 => 114,  327 => 113,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  293 => 121,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  266 => 107,  262 => 105,  247 => 84,  239 => 82,  237 => 38,  232 => 89,  228 => 78,  221 => 75,  215 => 83,  211 => 71,  202 => 71,  200 => 73,  177 => 66,  174 => 65,  168 => 61,  166 => 60,  144 => 58,  140 => 56,  126 => 45,  123 => 44,  105 => 27,  36 => 5,  142 => 73,  139 => 18,  133 => 47,  124 => 61,  107 => 51,  101 => 25,  65 => 23,  59 => 12,  45 => 9,  89 => 35,  82 => 33,  42 => 8,  26 => 3,  223 => 88,  214 => 90,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 79,  189 => 70,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 61,  152 => 48,  145 => 58,  130 => 48,  125 => 52,  119 => 45,  116 => 29,  112 => 42,  102 => 39,  98 => 24,  76 => 54,  73 => 23,  69 => 21,  32 => 5,  103 => 41,  91 => 31,  74 => 17,  70 => 22,  66 => 20,  56 => 14,  25 => 3,  22 => 4,  23 => 29,  17 => 1,  92 => 33,  86 => 20,  77 => 18,  57 => 13,  29 => 3,  24 => 9,  19 => 2,  68 => 24,  61 => 19,  44 => 12,  20 => 2,  161 => 81,  153 => 58,  150 => 49,  147 => 48,  143 => 20,  137 => 71,  129 => 46,  121 => 35,  118 => 50,  113 => 28,  104 => 36,  99 => 45,  94 => 63,  81 => 28,  78 => 32,  72 => 24,  64 => 19,  53 => 9,  50 => 14,  48 => 10,  41 => 7,  39 => 19,  35 => 5,  33 => 6,  30 => 5,  27 => 3,  182 => 70,  176 => 86,  169 => 66,  163 => 54,  160 => 53,  155 => 60,  151 => 62,  149 => 47,  141 => 43,  136 => 55,  134 => 50,  131 => 31,  128 => 53,  120 => 51,  117 => 43,  114 => 31,  109 => 37,  106 => 41,  100 => 47,  96 => 31,  93 => 36,  90 => 21,  87 => 29,  83 => 29,  79 => 16,  71 => 16,  62 => 20,  58 => 16,  55 => 12,  52 => 13,  49 => 12,  46 => 11,  43 => 8,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
