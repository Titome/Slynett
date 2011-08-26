<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResourceController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlyContentBundle:Resource:index.html.twig', array());
    }
}
