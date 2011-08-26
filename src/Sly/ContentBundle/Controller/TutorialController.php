<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TutorialController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlyContentBundle:Tutorial:index.html.twig', array());
    }
}
