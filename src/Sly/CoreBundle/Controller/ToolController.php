<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ToolController extends Controller
{
    public function sitemapAction($_format = 'xml')
    {
        $staticRoutes = array('homepage', 'terms', 'credits', 'contact');
        
        $em = $this->getDoctrine()->getEntityManager();
        $items = $em->getRepository('SlyContentBundle:Content')->getSitemapItems();
        
        return $this->render(sprintf('SlyCoreBundle:Tool:sitemap.%s.twig', $_format), array(
            'nowTimestamp' => time(),
            'staticRoutes' => $staticRoutes,
            'items' => $items,
        ));
    }
}