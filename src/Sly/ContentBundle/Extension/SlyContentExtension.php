<?php

namespace Sly\ContentBundle\Extension;

class SlyContentExtension extends \Twig_Extension {

    public function getFunctions() {
        return array(
            'checkActiveContentCategory' => new \Twig_Function_Method($this, 'checkActiveContentCategory'),
        );
    }

    public function checkActiveContentCategory($category, $contentCategories)
    {
        $contentCategoriesArray = array();
        
        foreach ($contentCategories as $cCat)
            $contentCategoriesArray[] = $cCat->getId();
        
        if (in_array($category->getId(), $contentCategoriesArray))
            return 'active';
    }
    
    public function getName()
    {
        return 'sly_content_extension';
    }
}