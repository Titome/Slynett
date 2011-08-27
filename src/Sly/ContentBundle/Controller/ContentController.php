<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContentController extends Controller
{
    public function categoriesAction($type)
    {        
        $em = $this->getDoctrine()->getEntityManager();

        $categories = $em->getRepository('SlyContentBundle:Category')->getCategories($type);
        
        return $this->render('SlyContentBundle:Content:categories.html.twig', array(
            'categories' => $categories,
            'mainRoute' => $type,
            'catRoute' => sprintf('%s_category', $type),
        ));
    }
}
