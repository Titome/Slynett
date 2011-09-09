<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

use Sly\ContentBundle\Entity\Content;

class ComponentController extends Controller
{
    public function lastActivityAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $items = $em->getRepository('SlyContentBundle:Content')->getLastActivity(
            $this->container->getParameter('sly.core.lastcontent.number', 15)
        );
        
        return $this->render('SlyCoreBundle:Component:lastActivity.html.twig', array(
            'items' => $items,
        ));
    }
}
