<?php

namespace Sly\CoreBundle\Extension;

class SlyExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'md5'  => new \Twig_Filter_Method($this, 'md5'),
            'checkActive'  => new \Twig_Filter_Method($this, 'checkActive'),
            'textEncode'  => new \Twig_Filter_Method($this, 'textEncode'),
            'getContentFromUrl'  => new \Twig_Filter_Method($this, 'getContentFromUrl'),
            'contentFilters'  => new \Twig_Filter_Method($this, 'contentFilters'),
            'checkActiveContentCategory' => new \Twig_Function_Method($this, 'checkActiveContentCategory'),
        );
    }
    
    public function md5($string) {
        return md5($string);
    }

    public function checkActive($currentRoute, $toCheck) {
        if (is_array($toCheck))
        {
            if (in_array($currentRoute, $toCheck))
                return 'active';
        }
        else
        {
            if ($currentRoute == $toCheck)
                return 'active';
        }
    }
    
    public function textEncode($text)
    {
        $encodedText = '';

        for ($i = 0; $i < strlen($text); $i++)
        {
            $char = $text{$i};
            $r = rand(0, 100);

            if ($r > 90 && $char != '@')
            {
                $encodedText .= $char;
            }
            else if ($r < 45)
            {
                $encodedText .= '&#x'.dechex(ord($char)).';';
            }
            else
            {
                $encodedText .= '&#'.ord($char).';';
            }
        }
        
        return $encodedText;
    }
    
    public function getContentFromUrl($url)
    {
        return @file_get_contents($url);
    }

    public function contentFilters($content)
    {
        /**
         * Just in prevision with adding some filters (BBCode, etc.)
         */
        
        return $content;
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
        return 'sly_extension';
    }
}