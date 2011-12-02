<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

use Sly\ContentBundle\Entity\Content;

use Sly\ContentBundle\Form\SearchType;

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
    
    public function searchRedirectAction()
    {
        $request = $this->get('request');
        
        $q = $request->query->get('q', '!');
        $c = implode('-', $request->query->get('c', array('!')));
        
        return $this->redirect($this->generateUrl('search', array(
            'query' => $q?$q:'!',
            'categories' => $c?$c:'!',
        )));
    }
    
    public function searchAction($query, $categories)
    {
        $request = $this->get('request');
        
        $allCategories = array('blog', 'tutorial', 'watch', 'snippet');
        
        if ($query == '!' && $categories == '!')
            return $this->render('SlyContentBundle:Default:search.html.twig', array(
                'allCategories' => $allCategories,
            ));
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $query = urldecode(($query == '!')?'':$query);
        $categories = ($categories == '!')?$allCategories:explode('-', urldecode($categories));

        $contentResults = $em->getRepository('SlyContentBundle:Content')->searchContent(
                $query,
                $categories,
                $this->container->getParameter('sly.content.feed.numberofitems')
        );
        
        return $this->render('SlyContentBundle:Default:searchResults.html.twig', array(
            'items' => $contentResults,
            'searchQuery' => $query,
            'searchCategories' => $categories,
            'allCategories' => $allCategories,
        ));
    }
}
