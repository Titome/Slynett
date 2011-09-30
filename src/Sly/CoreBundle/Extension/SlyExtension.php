<?php

namespace Sly\CoreBundle\Extension;

class SlyExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'checkActive'  => new \Twig_Filter_Method($this, 'checkActive'),
            'textEncode'  => new \Twig_Filter_Method($this, 'textEncode'),
            'getContentFromUrl'  => new \Twig_Filter_Method($this, 'getContentFromUrl'),
        );
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

    public function getName()
    {
        return 'sly_extension';
    }

}