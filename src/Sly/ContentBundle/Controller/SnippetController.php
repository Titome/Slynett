<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SnippetController extends Controller
{
    public function indexAction()
    {
        return $this->render('SlyContentBundle:Snippet:index.html.twig', array());
    }
}
