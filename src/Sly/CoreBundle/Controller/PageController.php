<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PageController extends Controller
{
    public function homepageAction()
    {
        return $this->render('SlyCoreBundle:Page:homepage.html.twig', array());
    }
    
    public function termsAction()
    {
        return $this->render('SlyCoreBundle:Page:terms.html.twig', array());
    }
    
    public function creditsAction()
    {
        return $this->render('SlyCoreBundle:Page:credits.html.twig', array());
    }
    
    public function contactAction()
    {
        return $this->render('SlyCoreBundle:Page:contact.html.twig', array());
    }
}
