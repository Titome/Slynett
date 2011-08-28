<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sly\ContentBundle\Entity\Content;
use Sly\ContentBundle\Form\BlogPostType;
use Sly\ContentBundle\Form\WatchLinkType;

class AdminController extends Controller
{
    public function blogAction()
    {        
        $em = $this->getDoctrine()->getEntityManager();
        
        $content = new Content();
        
        $contentForm = $this->createForm(new BlogPostType());
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $contentForm->bindRequest($request);
            
            if ($contentForm->isValid())
            {
                $content = $contentForm->getData();
                $content->setType('blog');
                                
                $em->persist($content);
                $em->flush();
                
                return $this->redirect($this->generateUrl('blog'));
            }
        }
        
        return $this->render('SlyContentBundle:Admin:blog.html.twig', array(
            'contentForm' => $contentForm->createView(),
        ));
    }
    
    public function watchAction()
    {        
        $em = $this->getDoctrine()->getEntityManager();
        
        $content = new Content();
        
        $contentForm = $this->createForm(new WatchLinkType());
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $contentForm->bindRequest($request);
            
            if ($contentForm->isValid())
            {
                $content = $contentForm->getData();
                $content->setType('watch');
                                
                $em->persist($content);
                $em->flush();
                
                return $this->redirect($this->generateUrl('watch'));
            }
        }
        
        return $this->render('SlyContentBundle:Admin:watch.html.twig', array(
            'contentForm' => $contentForm->createView(),
        ));
    }
}
