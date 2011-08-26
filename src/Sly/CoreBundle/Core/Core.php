<?php

namespace Sly\CoreBundle\Core;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Core
{
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}