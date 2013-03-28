<?php

namespace Bioversity\TraitBundle\Twig;

class TraitExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'is_array' => new \Twig_Filter_Method($this, 'isArray'),
            'base_term' => new \Twig_Filter_Method($this, 'getBaseTerm'),
            'ceil' => new \Twig_Filter_Method($this, 'ceil'),
        );
    }

    public function ceil($number)
    {
        return ceil($number);
    }
    
    public function isArray($item)
    {
        return is_array($item) || $item instanceof Traversable;
    }

    public function getBaseTerm($item)
    {
        return explode('/', $item);
    }
    
    public function getName()
    {
        return 'trait_extension';
    }
}