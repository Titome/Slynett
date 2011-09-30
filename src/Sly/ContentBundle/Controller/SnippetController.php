<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

use Sly\ContentBundle\Entity\Category;
use Sly\ContentBundle\Entity\Content;

class SnippetController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $contentQuery = $em->getRepository('SlyContentBundle:Content')->getContentQ('snippet');
                
        $contentPaginator = new Pagerfanta(new DoctrineORMAdapter($contentQuery));
        $contentPaginator->setMaxPerPage($this->container->getParameter('sly.content.snippet.maxperpage'));
        $contentPaginator->setCurrentPage($this->get('request')->query->get('page', 1));
        
        return $this->render('SlyContentBundle:Snippet:list.html.twig', array(
            'contentPaginator' => $contentPaginator,
        ));
    }
    
    public function categoryListAction(Category $category)
    {
        if (!$category->getStatus()) throw new NotFoundHttpException('This category has been disabled.');
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $contentQuery = $em->getRepository('SlyContentBundle:Content')->getContentByCategoryQ($category, 'snippet');
        
        $contentPaginator = new Pagerfanta(new DoctrineORMAdapter($contentQuery));
        $contentPaginator->setMaxPerPage($this->container->getParameter('sly.content.snippet.maxperpage'));
        $contentPaginator->setCurrentPage($this->get('request')->query->get('page', 1));
        
        return $this->render('SlyContentBundle:Snippet:categoryList.html.twig', array(
            'contentPaginator' => $contentPaginator,
            'category' => $category,
        ));
    }
    
    public function showAction(Request $request, Content $content)
    {
        if (!$content->getStatus()) throw new NotFoundHttpException('This post has been disabled.');
        
        return $this->render('SlyContentBundle:Snippet:show.html.twig', array(
            'item' => $content,
            'githubRawUrl' => $this->container->getParameter('sly.content.snippet.githubrawurlprefix'),
        ));
    }
}
