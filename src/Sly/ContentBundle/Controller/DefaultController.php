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
        
        return $this->redirect($this->generateUrl('search', array(
            'query' => $request->query->get('q', '!'),
            'categories' => implode('-', $request->query->get('c', array('!'))),
        )));
    }
    
    public function searchAction($query, $categories)
    {
        $request = $this->get('request');
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $query = urldecode(($query == '@')?'':$query);
        $categories = ($categories == '@')?array('blog', 'tutorial', 'watch', 'snippet'):explode('-', urldecode($categories));

        $contentResults = $em->getRepository('SlyContentBundle:Content')->searchContent(
                $query,
                $categories,
                $this->container->getParameter('sly.content.feed.numberofitems')
        );
        
        return $this->render('SlyContentBundle:Default:search.html.twig', array(
            'items' => $contentResults,
            'searchQuery' => $query,
            'searchCategories' => implode('-', $categories),
        ));
        
        /* --- */
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $content = new Content();
        
        $searchForm = $this->createForm(new SearchType());
        
        $request = $this->get('request');
        
        print_r($request->query->get('categories'));
        
//        if ($request->getMethod() == 'POST')
//        {
//            $searchForm->bindRequest($request);
//            
//            if ($searchForm->isValid())
//            {
//            }
//        }
        
        return $this->render('SlyContentBundle:Default:search.html.twig', array(
            'searchForm' => $searchForm->createView(),
        ));
    }
}
