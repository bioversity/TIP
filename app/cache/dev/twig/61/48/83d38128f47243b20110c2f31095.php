<?php

/* SensioDistributionBundle:Configurator:final.html.twig */
class __TwigTemplate_614883d38128f47243b20110c2f31095 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SensioDistributionBundle::Configurator/layout.html.twig");

        $this->blocks = array(
            'content_class' => array($this, 'block_content_class'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SensioDistributionBundle::Configurator/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content_class($context, array $blocks = array())
    {
        echo "config_done";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <h1>Well done!</h1>
    ";
        // line 6
        if ($this->getContext($context, "is_writable")) {
            // line 7
            echo "    <h2>Your distribution is configured!</h2>
    ";
        } else {
            // line 9
            echo "    <h2 class=\"configure-error\">Your distribution is almost configured but...</h2>
    ";
        }
        // line 11
        echo "    <h3>
        <span>
            ";
        // line 13
        if ($this->getContext($context, "is_writable")) {
            // line 14
            echo "                Your parameters.yml file has been overwritten with these parameters (in <em>";
            echo twig_escape_filter($this->env, $this->getContext($context, "yml_path"), "html", null, true);
            echo "</em>):
            ";
        } else {
            // line 16
            echo "                Your parameters.yml file is not writeable! Here are the parameters you can copy and paste in <em>";
            echo twig_escape_filter($this->env, $this->getContext($context, "yml_path"), "html", null, true);
            echo "</em>:
            ";
        }
        // line 18
        echo "        </span>
    </h3>

    <textarea class=\"symfony-configuration\">";
        // line 21
        echo twig_escape_filter($this->env, $this->getContext($context, "parameters"), "html", null, true);
        echo "</textarea>

    ";
        // line 23
        if ($this->getContext($context, "welcome_url")) {
            // line 24
            echo "        <ul>
            <li><a href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->getContext($context, "welcome_url"), "html", null, true);
            echo "\">Go to the Welcome page</a></li>
        </ul>
    ";
        }
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle:Configurator:final.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  18 => 1,  274 => 248,  260 => 236,  258 => 235,  255 => 234,  158 => 59,  183 => 68,  165 => 64,  162 => 63,  132 => 54,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  358 => 152,  350 => 149,  342 => 147,  340 => 146,  337 => 145,  328 => 140,  325 => 139,  278 => 114,  273 => 111,  271 => 110,  256 => 103,  252 => 101,  245 => 97,  238 => 219,  229 => 88,  224 => 86,  219 => 83,  213 => 79,  207 => 73,  191 => 68,  186 => 67,  181 => 63,  175 => 59,  172 => 67,  167 => 56,  354 => 163,  345 => 160,  341 => 159,  333 => 157,  331 => 141,  321 => 149,  314 => 145,  307 => 141,  300 => 137,  286 => 129,  279 => 125,  272 => 121,  257 => 109,  243 => 96,  236 => 218,  226 => 87,  212 => 82,  209 => 81,  204 => 78,  201 => 77,  196 => 69,  190 => 72,  180 => 64,  156 => 56,  788 => 469,  785 => 468,  774 => 466,  770 => 465,  766 => 463,  753 => 462,  727 => 457,  724 => 456,  705 => 454,  688 => 453,  684 => 451,  680 => 450,  676 => 449,  672 => 448,  668 => 447,  664 => 446,  661 => 445,  659 => 444,  642 => 443,  631 => 442,  616 => 437,  611 => 435,  607 => 434,  604 => 433,  602 => 432,  588 => 431,  556 => 401,  538 => 398,  521 => 397,  518 => 396,  516 => 395,  511 => 393,  506 => 391,  250 => 100,  205 => 76,  188 => 67,  179 => 87,  171 => 85,  164 => 82,  159 => 80,  154 => 77,  148 => 75,  110 => 52,  85 => 33,  60 => 21,  115 => 44,  111 => 40,  138 => 42,  95 => 23,  84 => 29,  80 => 19,  63 => 22,  47 => 15,  67 => 18,  75 => 21,  51 => 17,  241 => 59,  146 => 58,  108 => 42,  88 => 28,  21 => 3,  54 => 39,  38 => 11,  405 => 145,  399 => 144,  394 => 141,  386 => 160,  382 => 136,  378 => 134,  369 => 132,  365 => 131,  362 => 130,  360 => 153,  355 => 151,  352 => 150,  348 => 125,  338 => 158,  334 => 115,  332 => 114,  327 => 113,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  293 => 121,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  266 => 107,  262 => 105,  247 => 84,  239 => 82,  237 => 38,  232 => 89,  228 => 78,  221 => 75,  215 => 83,  211 => 71,  202 => 71,  200 => 73,  177 => 66,  174 => 61,  168 => 60,  166 => 60,  144 => 58,  140 => 56,  126 => 45,  123 => 44,  105 => 27,  36 => 5,  142 => 73,  139 => 18,  133 => 47,  124 => 61,  107 => 51,  101 => 25,  65 => 17,  59 => 18,  45 => 9,  89 => 34,  82 => 25,  42 => 8,  26 => 6,  223 => 88,  214 => 90,  210 => 78,  203 => 71,  199 => 83,  194 => 69,  192 => 79,  189 => 70,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 61,  152 => 48,  145 => 58,  130 => 47,  125 => 52,  119 => 45,  116 => 29,  112 => 42,  102 => 37,  98 => 36,  76 => 25,  73 => 24,  69 => 23,  32 => 8,  103 => 41,  91 => 31,  74 => 17,  70 => 22,  66 => 19,  56 => 14,  25 => 5,  22 => 3,  23 => 29,  17 => 1,  92 => 33,  86 => 20,  77 => 23,  57 => 15,  29 => 5,  24 => 3,  19 => 1,  68 => 20,  61 => 16,  44 => 10,  20 => 2,  161 => 81,  153 => 58,  150 => 49,  147 => 48,  143 => 57,  137 => 71,  129 => 46,  121 => 35,  118 => 50,  113 => 44,  104 => 36,  99 => 33,  94 => 35,  81 => 24,  78 => 32,  72 => 21,  64 => 19,  53 => 13,  50 => 13,  48 => 12,  41 => 7,  39 => 6,  35 => 7,  33 => 4,  30 => 4,  27 => 3,  182 => 70,  176 => 62,  169 => 66,  163 => 54,  160 => 53,  155 => 60,  151 => 62,  149 => 47,  141 => 56,  136 => 55,  134 => 50,  131 => 31,  128 => 53,  120 => 51,  117 => 45,  114 => 31,  109 => 37,  106 => 41,  100 => 34,  96 => 32,  93 => 30,  90 => 21,  87 => 30,  83 => 29,  79 => 24,  71 => 20,  62 => 17,  58 => 20,  55 => 14,  52 => 13,  49 => 11,  46 => 11,  43 => 14,  40 => 15,  37 => 9,  34 => 9,  31 => 6,  28 => 7,);
    }
}
