<?php

/* ::menuhead.html.twig */
class __TwigTemplate_d5108141899f5e5e7cb87e325a1dd51b extends Twig_Template
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
        echo "<div class=\"navbar navbar-fixed-top\">
  <div class=\"navbar-inner menu_top_inner\">
    
    <div class=\"container\">
      <div id=\"tip_logo\">
        <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("/bundles/bioversityontology/images/TIP-logo.gif"), "html", null, true);
        echo "\" />
      </div>
      
      <a data-target=\".nav_menu_top\" data-toggle=\"collapse\" class=\"btn btn-navbar\">
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </a>
      
      <a class=\"brand\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_homepage"), "html", null, true);
        echo "\">
        <strong>T</strong>rait
        <br/>
        <strong>I</strong>nformation <br/>
        <strong>P</strong>ortal
      </a>
      <div class=\"nav-collapse collapse\">
        <ul class=\"nav\">
        </ul>
      </div>
      
      <div class=\"nav_menu_top nav-collapse collapse first_row\">  
        ";
        // line 27
        $this->env->loadTemplate("::login.html.twig")->display($context);
        // line 28
        echo "      </div>

      ";
        // line 30
        $context["currentPath"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "attributes"), "get", array(0 => "_route"), "method");
        // line 31
        echo "      
      <div class=\"nav_menu_top nav-collapse collapse second_row\">
        <ul class=\"nav  pull-right\">
          <li class=\"root_page ";
        // line 34
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_homepage")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_homepage"), "html", null, true);
        echo "\">Home</a>
          </li>
          <li class=\"static_page ";
        // line 37
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_about")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_about"), "html", null, true);
        echo "\">About</a>
          </li>
          <li class=\"static_page ";
        // line 40
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_contact")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_contact"), "html", null, true);
        echo "\">Contact</a>
          </li>
          <li class=\"trait_page ";
        // line 43
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_browse_trait")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_trait"), "html", null, true);
        echo "\">Trait</a>
          </li>
          <!--
          <li class=\"research_page ";
        // line 47
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_browse_landrace")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_landrace"), "html", null, true);
        echo "\">Landrace</a>
          </li>
          <li class=\"research_page ";
        // line 50
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_browse_cwr")) {
            echo " active";
        }
        echo "\">
            <a href=\"";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_browse_cwr"), "html", null, true);
        echo "\">Crop Wild Relatives</a>
          </li>
          -->
          ";
        // line 55
        echo "          <!--
            <li class=\"dashboard_page ";
        // line 56
        if (($this->getContext($context, "currentPath") == "bioversity_ontology_dashboard")) {
            echo " active";
        }
        echo "\">
              <a href=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_dashboard"), "html", null, true);
        echo "\">Dashboard</a>
            </li>
          -->
          ";
        // line 61
        echo "        </ul>
        
        
        <ul class=\"nav  pull-right\">
          <li><a href=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("bioversity_ontology_database"), "html", null, true);
        echo "\">Database</a></li>
          <li><a data-toggle=\"modal\" href=\"#MenbersModal\">Members</a></li>
          <li><a data-toggle=\"modal\" href=\"#WorkshopsModal\">Workshops</a></li>
          <li><a data-toggle=\"modal\" href=\"#ProjectsModal\">Projects</a></li>
          <li><a data-toggle=\"modal\" href=\"#PublicationsModal\">Publications</a></li>
          <li><a data-toggle=\"modal\" href=\"#DataUsePolicyModal\">Data Use Policy</a></li>
          <li><a data-toggle=\"modal\" href=\"#AdvisoryBoardModal\">Advisory Board</a></li>
          <li><a data-toggle=\"modal\" href=\"#NewsArchiveModal\">News Archive</a></li>
          <li><a data-toggle=\"modal\" href=\"#GovernanceModal\">Governance</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "::menuhead.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  264 => 222,  235 => 196,  1174 => 331,  1168 => 330,  1162 => 329,  1156 => 328,  1150 => 327,  1144 => 326,  1138 => 325,  1132 => 324,  1126 => 323,  1110 => 317,  1103 => 316,  1101 => 315,  1098 => 314,  1075 => 310,  1050 => 309,  1048 => 308,  1045 => 307,  1033 => 302,  1028 => 301,  1026 => 300,  1023 => 299,  1014 => 293,  1008 => 291,  1005 => 290,  1000 => 289,  998 => 288,  995 => 287,  988 => 282,  981 => 280,  978 => 276,  974 => 275,  971 => 274,  968 => 273,  966 => 272,  963 => 271,  955 => 267,  953 => 266,  950 => 265,  943 => 260,  940 => 259,  932 => 254,  928 => 253,  924 => 252,  921 => 251,  919 => 250,  916 => 249,  908 => 245,  906 => 241,  904 => 240,  901 => 239,  880 => 233,  877 => 232,  874 => 231,  871 => 230,  868 => 229,  865 => 228,  862 => 227,  859 => 226,  856 => 225,  853 => 224,  851 => 223,  848 => 222,  840 => 216,  837 => 215,  835 => 214,  832 => 213,  824 => 209,  821 => 208,  819 => 207,  816 => 206,  808 => 202,  805 => 201,  803 => 200,  800 => 199,  792 => 195,  789 => 194,  787 => 193,  776 => 188,  773 => 187,  771 => 186,  768 => 185,  760 => 181,  757 => 180,  755 => 179,  752 => 178,  744 => 174,  742 => 173,  739 => 172,  731 => 168,  728 => 167,  726 => 166,  715 => 161,  712 => 160,  710 => 159,  708 => 158,  705 => 157,  698 => 152,  690 => 151,  685 => 150,  679 => 148,  674 => 146,  671 => 145,  663 => 139,  661 => 138,  659 => 136,  658 => 135,  653 => 134,  647 => 132,  644 => 131,  642 => 130,  639 => 129,  630 => 123,  626 => 122,  622 => 121,  618 => 120,  613 => 119,  604 => 116,  602 => 115,  599 => 114,  583 => 110,  581 => 109,  578 => 108,  562 => 104,  560 => 103,  557 => 102,  540 => 98,  528 => 96,  521 => 93,  511 => 90,  493 => 89,  491 => 88,  488 => 87,  479 => 82,  476 => 81,  473 => 80,  467 => 78,  465 => 77,  460 => 76,  457 => 75,  454 => 74,  448 => 72,  446 => 71,  438 => 70,  436 => 69,  433 => 68,  427 => 64,  419 => 62,  414 => 61,  410 => 60,  405 => 59,  403 => 58,  400 => 57,  391 => 52,  385 => 50,  382 => 49,  380 => 48,  367 => 43,  365 => 42,  362 => 41,  351 => 36,  348 => 35,  343 => 33,  332 => 27,  327 => 26,  319 => 23,  288 => 14,  276 => 8,  270 => 6,  265 => 4,  254 => 329,  246 => 325,  244 => 324,  242 => 323,  239 => 322,  231 => 313,  221 => 298,  218 => 296,  216 => 287,  211 => 271,  206 => 170,  195 => 258,  193 => 249,  185 => 238,  154 => 191,  18 => 1,  260 => 236,  258 => 331,  255 => 234,  168 => 60,  158 => 59,  60 => 16,  183 => 68,  165 => 64,  132 => 55,  386 => 160,  383 => 159,  377 => 47,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  350 => 149,  342 => 147,  340 => 32,  337 => 145,  328 => 140,  325 => 139,  318 => 135,  312 => 21,  309 => 20,  306 => 129,  304 => 128,  290 => 15,  287 => 119,  285 => 13,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  262 => 3,  256 => 330,  252 => 328,  245 => 97,  238 => 219,  232 => 89,  229 => 307,  213 => 286,  207 => 73,  205 => 76,  191 => 68,  188 => 239,  175 => 59,  172 => 213,  101 => 25,  354 => 37,  345 => 34,  341 => 159,  338 => 158,  333 => 157,  331 => 141,  323 => 138,  321 => 24,  314 => 22,  307 => 141,  300 => 137,  279 => 125,  257 => 109,  250 => 327,  243 => 96,  236 => 320,  212 => 82,  209 => 81,  204 => 78,  201 => 77,  196 => 69,  190 => 248,  133 => 47,  126 => 51,  784 => 192,  781 => 465,  770 => 463,  766 => 462,  762 => 460,  749 => 459,  723 => 165,  720 => 453,  701 => 451,  684 => 450,  680 => 448,  676 => 147,  672 => 446,  668 => 445,  664 => 444,  660 => 137,  657 => 442,  655 => 441,  638 => 440,  627 => 439,  612 => 434,  607 => 117,  603 => 431,  600 => 430,  586 => 429,  554 => 399,  536 => 396,  519 => 92,  516 => 394,  514 => 91,  509 => 391,  504 => 389,  248 => 326,  200 => 262,  186 => 67,  180 => 222,  177 => 144,  174 => 219,  167 => 206,  162 => 199,  159 => 198,  144 => 177,  135 => 56,  122 => 129,  97 => 43,  111 => 40,  138 => 42,  95 => 23,  84 => 46,  63 => 17,  47 => 12,  67 => 13,  51 => 27,  241 => 59,  237 => 38,  146 => 58,  139 => 171,  108 => 38,  105 => 37,  88 => 27,  21 => 3,  54 => 12,  38 => 11,  305 => 102,  299 => 125,  296 => 97,  293 => 16,  291 => 95,  286 => 129,  280 => 115,  277 => 87,  274 => 248,  272 => 121,  267 => 5,  253 => 81,  249 => 79,  234 => 314,  226 => 306,  224 => 299,  219 => 83,  215 => 83,  208 => 270,  202 => 71,  198 => 259,  181 => 63,  164 => 205,  124 => 144,  107 => 102,  80 => 26,  75 => 37,  36 => 15,  156 => 56,  148 => 118,  142 => 172,  140 => 71,  127 => 145,  123 => 44,  115 => 48,  110 => 39,  85 => 26,  65 => 37,  59 => 31,  45 => 9,  89 => 56,  82 => 41,  42 => 21,  26 => 9,  223 => 88,  214 => 90,  210 => 78,  203 => 264,  199 => 83,  194 => 69,  192 => 90,  189 => 70,  187 => 62,  184 => 76,  178 => 72,  170 => 64,  157 => 192,  152 => 185,  145 => 58,  130 => 47,  125 => 52,  119 => 92,  116 => 29,  112 => 108,  102 => 87,  98 => 36,  76 => 24,  73 => 24,  69 => 19,  32 => 14,  103 => 44,  91 => 28,  74 => 31,  70 => 35,  66 => 19,  56 => 14,  25 => 5,  22 => 3,  23 => 5,  17 => 1,  92 => 41,  86 => 40,  77 => 32,  57 => 30,  29 => 4,  24 => 6,  19 => 2,  68 => 20,  61 => 40,  44 => 21,  20 => 2,  161 => 58,  153 => 65,  150 => 49,  147 => 61,  143 => 57,  137 => 165,  129 => 156,  121 => 35,  118 => 50,  113 => 40,  104 => 101,  99 => 33,  94 => 67,  81 => 38,  78 => 32,  72 => 22,  64 => 34,  53 => 28,  50 => 13,  48 => 12,  41 => 7,  39 => 7,  35 => 15,  33 => 4,  30 => 4,  27 => 3,  182 => 236,  176 => 62,  169 => 212,  163 => 54,  160 => 53,  155 => 54,  151 => 62,  149 => 184,  141 => 57,  136 => 55,  134 => 164,  131 => 31,  128 => 53,  120 => 50,  117 => 114,  114 => 113,  109 => 47,  106 => 33,  100 => 30,  96 => 29,  93 => 30,  90 => 66,  87 => 47,  83 => 38,  79 => 40,  71 => 20,  62 => 39,  58 => 20,  55 => 14,  52 => 26,  49 => 11,  46 => 11,  43 => 11,  40 => 15,  37 => 9,  34 => 5,  31 => 4,  28 => 10,);
    }
}