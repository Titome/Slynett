<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PageController extends Controller
{
    
    public function homepageAction()
    {
        return $this->render('SlyCoreBundle:Page:homepage.html.twig', array());
    }
}
