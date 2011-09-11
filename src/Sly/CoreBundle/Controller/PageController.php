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
                $contact = $contactForm->getData();
                
                $mailer = $this->get('mailer');
            
                $message = \Swift_Message::newInstance()
                    ->setSubject($contact->getSubject())
                    ->setFrom(array($contact->getEmail() => $contact->getName()))
                    ->setTo($this->container->getParameter('project_email'))
                    ->setBody($this->renderView('SlyCoreBundle:Email:contact.txt.twig', array('contact' => $contact)))
                ;
                
                $mailer->send($message);
                
                return $this->redirect($this->generateUrl('homepage'));
            }
        }
        
        return $this->render('SlyCoreBundle:Page:contact.html.twig', array(
            'contactForm' => $contactForm->createView(),
        ));
    }
}
