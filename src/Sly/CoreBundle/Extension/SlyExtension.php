<?php

namespace Sly\CoreBundle\Extension;

class SlyExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'md5'  => new \Twig_Filter_Method($this, 'md5'),
            'checkActive'  => new \Twig_Filter_Method($this, 'checkActive'),
            'textEncode'  => new \Twig_Filter_Method($this, 'textEncode', array('pre_escape' => 'html', 'is_safe' => array('html'))),
            'getContentFromUrl'  => new \Twig_Filter_Method($this, 'getContentFromUrl'),
            'contentFilters'  => new \Twig_Filter_Method($this, 'contentFilters'),
            'autoLink'  => new \Twig_Filter_Method($this, 'autoLink', array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }
    
    public function md5($string)
    {
        return md5($string);
    }

    public function checkActive($currentRoute, $toCheck)
    {
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
    
    public function autoLink($string)
    {
        $string = $this->autoLinkEmail($string);
        
        return preg_replace_callback(
           '~
( # leading text
<\w+.*?>| # leading HTML tag, or
[^=!:\'"/]| # leading punctuation, or
^ # beginning of line
)
(
(?:https?://)| # protocol spec, or
(?:www\.) # www.*
)
(
[-\w]+ # subdomain or domain
(?:\.[-\w]+)* # remaining subdomains or domain
(?::\d+)? # port
(?:/(?:(?:[\~\w\+%-]|(?:[,.;:][^\s$]))+)?)* # path
(?:\?[\w\+%&=.;-]+)? # query string
(?:\#[\w\-]*)? # trailing anchor
)
([[:punct:]]|\s|<|$) # trailing text
~x',
          create_function('$matches', '
if (preg_match("/<a\s/i", $matches[1]))
{
return $matches[0];
}
else
{
return $matches[1].\'<a target="_blank" href="\'.($matches[2] == "www." ? "http://www." : $matches[2]).$matches[3].\'">\'.$matches[2].$matches[3].\'</a>\'.$matches[4];
}
')
        , $string);
    }
    
    public function autoLinkEmail($string)
    {
        return preg_replace('/([\w\.!#\$%\-+.]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)+)/', '<a href="mailto:\\1">\\1</a>', $string);
        
        
    }
    
    public function getName()
    {
        return 'sly_extension';
    }
}