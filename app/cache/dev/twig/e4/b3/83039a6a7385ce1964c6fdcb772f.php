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
        return array (  60 => 16,  183 => 68,  165 => 64,  132 => 54,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  350 => 149,  342 => 147,  340 => 146,  337 => 145,  328 => 140,  325 => 139,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  290 => 120,  287 => 119,  285 => 118,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  262 => 105,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  213 => 79,  207 => 77,  205 => 76,  191 => 68,  188 => 67,  175 => 59,  172 => 67,  101 => 25,  354 => 163,  345 => 160,  341 => 159,  338 => 158,  333 => 157,  331 => 141,  323 => 138,  321 => 149,  314 => 145,  307 => 141,  300 => 137,  279 => 125,  257 => 109,  250 => 100,  243 => 96,  236 => 97,  212 => 82,  209 => 81,  204 => 78,  201 => 77,  196 => 74,  190 => 72,  133 => 47,  126 => 45,  784 => 466,  781 => 465,  770 => 463,  766 => 462,  762 => 460,  749 => 459,  723 => 454,  720 => 453,  701 => 451,  684 => 450,  680 => 448,  676 => 447,  672 => 446,  668 => 445,  664 => 444,  660 => 443,  657 => 442,  655 => 441,  638 => 440,  627 => 439,  612 => 434,  607 => 432,  603 => 431,  600 => 430,  586 => 429,  554 => 399,  536 => 396,  519 => 395,  516 => 394,  514 => 393,  509 => 391,  504 => 389,  248 => 136,  200 => 73,  186 => 69,  180 => 69,  177 => 85,  174 => 84,  167 => 56,  162 => 63,  159 => 79,  144 => 72,  135 => 69,  122 => 59,  97 => 43,  111 => 40,  138 => 42,  95 => 23,  84 => 29,  63 => 23,  47 => 13,  67 => 20,  51 => 22,  241 => 59,  237 => 38,  146 => 46,  139 => 18,  108 => 42,  105 => 27,  88 => 60,  21 => 1,  54 => 13,  38 => 6,  305 => 102,  299 => 125,  296 => 97,  293 => 121,  291 => 95,  286 => 129,  280 => 115,  277 => 87,  274 => 86,  272 => 121,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 87,  224 => 86,  219 => 83,  215 => 83,  208 => 68,  202 => 71,  198 => 64,  181 => 63,  164 => 59,  124 => 48,  107 => 42,  80 => 19,  75 => 24,  36 => 5,  156 => 56,  148 => 52,  142 => 51,  140 => 71,  127 => 49,  123 => 44,  115 => 55,  110 => 37,  85 => 34,  65 => 23,  59 => 12,  45 => 9,  89 => 35,  82 => 33,  42 => 8,  26 => 3,  223 => 88,  214 => 90,  210 => 78,  203 => 93,  199 => 83,  194 => 69,  192 => 90,  189 => 70,  187 => 62,  184 => 76,  178 => 72,  170 => 64,  157 => 78,  152 => 48,  145 => 58,  130 => 48,  125 => 52,  119 => 45,  116 => 29,  112 => 43,  102 => 39,  98 => 24,  76 => 54,  73 => 23,  69 => 21,  32 => 5,  103 => 41,  91 => 31,  74 => 17,  70 => 22,  66 => 20,  56 => 14,  25 => 3,  22 => 4,  23 => 29,  17 => 1,  92 => 33,  86 => 20,  77 => 18,  57 => 13,  29 => 3,  24 => 9,  19 => 2,  68 => 24,  61 => 19,  44 => 12,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 20,  137 => 45,  129 => 46,  121 => 35,  118 => 50,  113 => 28,  104 => 35,  99 => 5,  94 => 63,  81 => 28,  78 => 32,  72 => 32,  64 => 19,  53 => 9,  50 => 14,  48 => 10,  41 => 7,  39 => 10,  35 => 5,  33 => 6,  30 => 5,  27 => 3,  182 => 70,  176 => 71,  169 => 66,  163 => 54,  160 => 53,  155 => 54,  151 => 62,  149 => 47,  141 => 43,  136 => 55,  134 => 50,  131 => 31,  128 => 53,  120 => 51,  117 => 43,  114 => 31,  109 => 38,  106 => 41,  100 => 47,  96 => 30,  93 => 36,  90 => 21,  87 => 29,  83 => 38,  79 => 16,  71 => 16,  62 => 20,  58 => 16,  55 => 12,  52 => 13,  49 => 12,  46 => 11,  43 => 19,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
