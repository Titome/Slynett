<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WatchController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlyContentBundle:Watch:index.html.twig', array());
    }
}
