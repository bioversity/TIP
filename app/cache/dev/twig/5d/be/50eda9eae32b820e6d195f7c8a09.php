<?php

/* SensioDistributionBundle:Configurator/Step:secret.html.twig */
class __TwigTemplate_5dbe50eda9eae32b820e6d195f7c8a09 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SensioDistributionBundle::Configurator/layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        echo "Symfony - Configure global Secret";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        $this->env->getExtension('form')->renderer->setTheme($this->getContext($context, "form"), array(0 => "SensioDistributionBundle::Configurator/form.html.twig"));
        // line 7
        echo "    ";
        $this->env->loadTemplate("SensioDistributionBundle::Configurator/steps.html.twig")->display(array_merge($context, array("index" => $this->getContext($context, "index"), "count" => $this->getContext($context, "count"))));
        // line 8
        echo "
    <h1>Global Secret</h1>
    <p>Configure the global secret for your website (the secret is used for the CSRF protection among other things):</p>

    ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'errors');
        echo "
    <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_configurator_step", array("index" => $this->getContext($context, "index"))), "html", null, true);
        echo " \" method=\"POST\">
        <div class=\"symfony-form-row\">
            ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "secret"), 'label');
        echo "
            <div class=\"symfony-form-field\">
                ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "secret"), 'widget');
        echo "
                <a class=\"symfony-button-grey\" href=\"#\" onclick=\"generateSecret(); return false;\">Generate</a>
                <div class=\"symfony-form-errors\">
                    ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getContext($context, "form"), "secret"), 'errors');
        echo "
                </div>
            </div>
        </div>

        ";
        // line 25
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'rest');
        echo "

        <div class=\"symfony-form-footer\">
            <p><input type=\"submit\" value=\"Next Step\" class=\"symfony-button-grey\" /></p>
            <p>* mandatory fields</p>
        </div>

    </form>

    <script type=\"text/javascript\">
        function generateSecret()
        {
            var result = '';
            for (i=0; i < 32; i++) {
                result += Math.round(Math.random()*16).toString(16);
            }
            document.getElementById('distributionbundle_secret_step_secret').value = result;
        }
    </script>
";
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle:Configurator/Step:secret.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  18 => 1,  260 => 236,  258 => 235,  255 => 234,  168 => 60,  158 => 59,  60 => 21,  183 => 68,  165 => 64,  132 => 54,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  350 => 149,  342 => 147,  340 => 146,  337 => 145,  328 => 140,  325 => 139,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  290 => 120,  287 => 119,  285 => 118,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  262 => 105,  256 => 103,  252 => 101,  245 => 97,  238 => 219,  232 => 89,  229 => 88,  213 => 79,  207 => 73,  205 => 76,  191 => 68,  188 => 67,  175 => 59,  172 => 67,  101 => 25,  354 => 163,  345 => 160,  341 => 159,  338 => 158,  333 => 157,  331 => 141,  323 => 138,  321 => 149,  314 => 145,  307 => 141,  300 => 137,  279 => 125,  257 => 109,  250 => 100,  243 => 96,  236 => 218,  212 => 82,  209 => 81,  204 => 78,  201 => 77,  196 => 69,  190 => 72,  133 => 47,  126 => 45,  784 => 466,  781 => 465,  770 => 463,  766 => 462,  762 => 460,  749 => 459,  723 => 454,  720 => 453,  701 => 451,  684 => 450,  680 => 448,  676 => 447,  672 => 446,  668 => 445,  664 => 444,  660 => 443,  657 => 442,  655 => 441,  638 => 440,  627 => 439,  612 => 434,  607 => 432,  603 => 431,  600 => 430,  586 => 429,  554 => 399,  536 => 396,  519 => 395,  516 => 394,  514 => 393,  509 => 391,  504 => 389,  248 => 136,  200 => 73,  186 => 67,  180 => 64,  177 => 85,  174 => 61,  167 => 56,  162 => 63,  159 => 79,  144 => 72,  135 => 69,  122 => 59,  97 => 43,  111 => 40,  138 => 42,  95 => 23,  84 => 29,  63 => 22,  47 => 15,  67 => 15,  51 => 17,  241 => 59,  237 => 38,  146 => 58,  139 => 18,  108 => 42,  105 => 27,  88 => 28,  21 => 3,  54 => 39,  38 => 11,  305 => 102,  299 => 125,  296 => 97,  293 => 121,  291 => 95,  286 => 129,  280 => 115,  277 => 87,  274 => 248,  272 => 121,  267 => 82,  253 => 81,  249 => 79,  234 => 77,  226 => 87,  224 => 86,  219 => 83,  215 => 83,  208 => 68,  202 => 71,  198 => 64,  181 => 63,  164 => 59,  124 => 48,  107 => 42,  80 => 19,  75 => 25,  36 => 6,  156 => 56,  148 => 52,  142 => 51,  140 => 71,  127 => 49,  123 => 44,  115 => 55,  110 => 37,  85 => 33,  65 => 12,  59 => 18,  45 => 15,  89 => 34,  82 => 23,  42 => 8,  26 => 6,  223 => 88,  214 => 90,  210 => 78,  203 => 71,  199 => 83,  194 => 69,  192 => 90,  189 => 70,  187 => 62,  184 => 76,  178 => 72,  170 => 64,  157 => 78,  152 => 48,  145 => 58,  130 => 47,  125 => 52,  119 => 45,  116 => 29,  112 => 43,  102 => 37,  98 => 36,  76 => 25,  73 => 24,  69 => 23,  32 => 8,  103 => 41,  91 => 31,  74 => 17,  70 => 22,  66 => 19,  56 => 14,  25 => 5,  22 => 3,  23 => 29,  17 => 1,  92 => 33,  86 => 20,  77 => 23,  57 => 15,  29 => 5,  24 => 3,  19 => 1,  68 => 20,  61 => 6,  44 => 10,  20 => 2,  161 => 58,  153 => 53,  150 => 49,  147 => 48,  143 => 57,  137 => 45,  129 => 46,  121 => 35,  118 => 50,  113 => 44,  104 => 35,  99 => 33,  94 => 35,  81 => 28,  78 => 32,  72 => 25,  64 => 19,  53 => 15,  50 => 13,  48 => 12,  41 => 9,  39 => 7,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 62,  169 => 66,  163 => 54,  160 => 53,  155 => 54,  151 => 62,  149 => 47,  141 => 56,  136 => 55,  134 => 50,  131 => 31,  128 => 53,  120 => 51,  117 => 45,  114 => 31,  109 => 38,  106 => 41,  100 => 34,  96 => 32,  93 => 30,  90 => 21,  87 => 30,  83 => 38,  79 => 24,  71 => 23,  62 => 17,  58 => 20,  55 => 19,  52 => 13,  49 => 16,  46 => 11,  43 => 14,  40 => 15,  37 => 9,  34 => 9,  31 => 6,  28 => 7,);
    }
}
