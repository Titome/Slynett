<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComponentController extends Controller
{
    public function categoriesAction($type, $activeCategory = null, $noActive = null)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $categories = $em->getRepository('SlyContentBundle:Category')->getCategories($type);
        
        return $this->render('SlyContentBundle:Component:categories.html.twig', array(
            'categories' => $categories,
            'mainRoute' => $type,
            'catRoute' => sprintf('%s_category', $type),
            'activeCategory' => $activeCategory,
            'noActive' => $noActive,
        ));
    }
    
    public function lastItemsAction($type = null, $categories = null, $slider = false)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $items = $em->getRepository('SlyContentBundle:Content')->getLastItems($type, $categories, $this->container->getParameter('sly.content.blog.otheritems.number', 5));
        
        return $this->render(sprintf('SlyContentBundle:Component:%s.html.twig', $slider?'lastItemsSlider':'lastItems'), array(
            'items' => $items,
            'mainRoute' => $type,
            'itemRoute' => sprintf('%s_show', $type),
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
    
    public function disqusCountJSAction()
    {
        return $this->render('SlyContentBundle:Component:disqusCount.js.html.twig', array(
            'disqus' => $this->container->getParameter('sly.content.disqus'),
        ));
    }
}
