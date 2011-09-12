<?php

namespace Sly\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sly\ContentBundle\Entity\Content;
use Sly\ContentBundle\Form\BlogPostType;
use Sly\ContentBundle\Form\WatchLinkType;
use Sly\ContentBundle\Form\TutorialType;
use Sly\ContentBundle\Form\SnippetType;

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
        $bitly = $this->get('sly.bitly');
        
        if ($request->getMethod() == 'POST')
        {
            $contentForm->bindRequest($request);
            
            if ($contentForm->isValid())
            {
                $content = $contentForm->getData();
                $content->setType('watch');
                
                $minilink = $bitly->generateMinilink($content->getLink());
                $content->setMinilink($minilink->data->url);
                                
                $em->persist($content);
                $em->flush();
                
                return $this->redirect($this->generateUrl('watch'));
            }
        }
        
        return $this->render('SlyContentBundle:Admin:watch.html.twig', array(
            'contentForm' => $contentForm->createView(),
        ));
    }

    public function tutorialAction()
    {        
        $em = $this->getDoctrine()->getEntityManager();
        
        $content = new Content();
        
        $contentForm = $this->createForm(new TutorialType());
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $contentForm->bindRequest($request);
            
            if ($contentForm->isValid())
            {
                $content = $contentForm->getData();
                $content->setType('tutorial');
                                
                $em->persist($content);
                $em->flush();
                
                return $this->redirect($this->generateUrl('tutorial'));
            }
        }
        
        return $this->render('SlyContentBundle:Admin:tutorial.html.twig', array(
            'contentForm' => $contentForm->createView(),
        ));
    }
    
    public function snippetAction()
    {        
        $em = $this->getDoctrine()->getEntityManager();
        
        $content = new Content();
        
        $contentForm = $this->createForm(new SnippetType());
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $contentForm->bindRequest($request);
            
            if ($contentForm->isValid())
            {
                $content = $contentForm->getData();
                $content->setType('snippet');
                                
                $em->persist($content);
                $em->flush();
                
                return $this->redirect($this->generateUrl('snippet'));
            }
        }
        
        return $this->render('SlyContentBundle:Admin:snippet.html.twig', array(
            'contentForm' => $contentForm->createView(),
        ));
    }
}
