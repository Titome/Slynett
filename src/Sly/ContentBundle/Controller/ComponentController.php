<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComponentController extends Controller
{
    public function categoriesAction($type, $activeCategories = null, $noActive = null)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $categories = $em->getRepository('SlyContentBundle:Category')->getCategories($type);
        
        return $this->render('SlyContentBundle:Component:categories.html.twig', array(
            'categories' => $categories,
            'mainRoute' => $type,
            'catRoute' => sprintf('%s_category', $type),
            'activeCategories' => $activeCategories,
            'noActive' => $noActive,
        ));
    }
    
    public function lastItemsAction($type = null, $categories = null, $withoutItem = null, $withPicture = null, $template = null, $count = null)
    {
        $em = $this->getDoctrine()->getEntityManager();
        
        if (!$count)
            $count = $this->container->getParameter('sly.content.blog.otheritems.number', 5);

        $items = $em->getRepository('SlyContentBundle:Content')->getLastItems($type, $categories, $count, $withoutItem);
        
        return $this->render(sprintf('SlyContentBundle:Component:lastItems%s.html.twig', $template?'.'.$template:null), array(
            'items' => $items,
            'mainRoute' => $type,
            'itemRoute' => sprintf('%s_show', $type),
            'withPicture' => $withPicture,
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
    
    public function disqusLastCommentsAction()
    {
        return $this->render('SlyContentBundle:Component:disqusLastComments.html.twig', array(
            'disqus' => $this->container->getParameter('sly.content.disqus'),
        ));
    }
}
