<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComponentController extends Controller
{
    public function categoriesAction($type)
    {        
        $em = $this->getDoctrine()->getEntityManager();

        $categories = $em->getRepository('SlyContentBundle:Category')->getCategories($type);
        
        return $this->render('SlyContentBundle:Component:categories.html.twig', array(
            'categories' => $categories,
            'mainRoute' => $type,
            'catRoute' => sprintf('%s_category', $type),
        ));
    }
    
    public function disqusJSAction($item, $type = 'general')
    {
        return $this->render('SlyContentBundle:Component:disqus.js.html.twig', array(
            'item' => $item,
            'type' => $type,
            'disqus' => $this->container->getParameter('sly.content.disqus'),
        ));
    }
}
