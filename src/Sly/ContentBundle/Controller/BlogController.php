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

class BlogController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $contentQuery = $em->getRepository('SlyContentBundle:Content')->getContentQ('blog');
                
        $contentPaginator = new Pagerfanta(new DoctrineORMAdapter($contentQuery));
        $contentPaginator->setMaxPerPage($this->container->getParameter('sly.content.blog.maxperpage'));
        $contentPaginator->setCurrentPage($this->get('request')->query->get('page', 1));
        
        return $this->render('SlyContentBundle:Blog:list.html.twig', array(
            'contentPaginator' => $contentPaginator,
        ));
    }
    
    public function categoryListAction(Category $category)
    {
        if (!$category->getStatus()) throw new NotFoundHttpException('This category has been disabled.');
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $contentQuery = $em->getRepository('SlyContentBundle:Content')->getContentByCategoryQ($category, 'blog');
        
        $contentPaginator = new Pagerfanta(new DoctrineORMAdapter($contentQuery));
        $contentPaginator->setMaxPerPage($this->container->getParameter('sly.content.blog.maxperpage'));
        $contentPaginator->setCurrentPage($this->get('request')->query->get('page', 1));
        
        return $this->render('SlyContentBundle:Blog:categoryList.html.twig', array(
            'contentPaginator' => $contentPaginator,
            'category' => $category,
        ));
    }
    
    public function showAction(Request $request, Content $content)
    {
        if (!$content->getStatus()) throw new NotFoundHttpException('This post has been disabled.');
        
        return $this->render('SlyContentBundle:Blog:show.html.twig', array(
            'item' => $content,
        ));
    }
}
