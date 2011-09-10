<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AuthorController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlyCoreBundle:Author:index.html.twig', array());
    }
    
    public function skillsAction()
    {
        return $this->render('SlyCoreBundle:Author:skills.html.twig', array());
    }
}
