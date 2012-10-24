<?php

/* BioversityOntologyBundle:Default:about.html.twig */
class __TwigTemplate_a7c9d65db7e4bfe6be4c7044f6a9e456 extends Twig_Template
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
        echo "    <div class=\"span9\">
      <h2>Plant trait diversity – CWR and Landraces</h2>
      <p>
        TIP is a network of European CWR and Landraces
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in fermentum enim. Aliquam erat volutpat. Praesent risus arcu, fermentum eget adipiscing in, tincidunt vel nunc. Nam eget feugiat urna.
      </p>
      <p>
        Vivamus et fermentum lorem. Integer in arcu neque, consectetur scelerisque lorem. Nunc sollicitudin mauris ac tellus semper quis placerat mi tempor. Fusce ultrices lacus risus, sit amet molestie enim. Mauris elementum adipiscing feugiat. Praesent viverra consequat aliquet. Pellentesque iaculis imperdiet velit, eget lacinia libero congue sed. Nullam vel nibh nunc, at pellentesque justo. Donec vitae turpis est. Cras non ipsum dui. 
      </p>
      <h3>Main objectives</h3>
      <ul>
        <li>Provide an European documentation of plant traits</li>
        <li>Promote trait use for breeding and biodiversity science</li>
        <li>Support the design of trait models for use</li>
        <li>Provide national inventory information on CWR and landraces</li>
        <li>Promote conservation plans and strategies</li>
      </ul>
      <h3>Current state of data warehouse and network</h3>
      <ul>
        <li>X? trait records for about 5000 plant species</li>
        <li>400 collaborators from 380 institutes/organizations</li>
        <li>XXX scientific projects requesting plant trait data from TIP</li>
        <li>200 National inventories</li>
        <li>50 conservation strategies in place</li>
      </ul>
    </div>
";
    }

    public function getTemplateName()
    {
        return "BioversityOntologyBundle:Default:about.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 5,  29 => 4,  26 => 3,);
    }
}
