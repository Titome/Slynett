<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

class DefaultController extends Controller
{
    public function feedAction($type = null)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $contentResults = $em->getRepository('SlyContentBundle:Content')->getFeed(
                $type,
                $this->container->getParameter('sly.content.feed.numberofitems')
        );
        
        return $this->render('SlyContentBundle:Default:feed.xml.twig', array(
            'items' => $contentResults,
            'now' => time(),
            'type' => $type,
            'watchFeedTitle' => $this->container->getParameter('sly.content.watch.feedtitleskel'),
        ));
    }
}
