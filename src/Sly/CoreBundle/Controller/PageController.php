<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sly\CoreBundle\Form\ContactType;

class PageController extends Controller
{
    public function homepageAction()
    {
        return $this->render('SlyCoreBundle:Page:homepage.html.twig', array());
    }
    
    public function termsAction()
    {
        return $this->render('SlyCoreBundle:Page:terms.html.twig', array());
    }
    
    public function creditsAction()
    {
        return $this->render('SlyCoreBundle:Page:credits.html.twig', array());
    }
    
    public function contactAction()
    {
        $contactForm = $this->createForm(new ContactType());
        
        $request = $this->get('request');
        
        if ($request->getMethod() == 'POST')
        {
            $contactForm->bindRequest($request);
            
            if ($contactForm->isValid())
            {
                
                return $this->redirect($this->generateUrl('contact'));
            }
        }
        
        return $this->render('SlyCoreBundle:Page:contact.html.twig', array(
            'contactForm' => $contactForm->createView(),
        ));
    }
}
