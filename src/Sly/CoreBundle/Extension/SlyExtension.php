<?php

namespace Sly\CoreBundle\Extension;

class SlyExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            'checkActive'  => new \Twig_Filter_Method($this, 'checkActive'),
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

    public function getName()
    {
        return 'sly_extension';
    }

}