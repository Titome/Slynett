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
        $subjects = array(
            'Prise de contact - Questions diverses',
            'Suggestions',
            'Idéées de futurs tutoriels',
            'Propositions de postes ou missions',
            'Partenariats',
            'Autres',
        );
        
        $request = $this->get('request');
        
        $contactForm = $this->createForm(new ContactType(), null, array(
            'ref' => $request->query->get('ref'),
            'subjects' => $subjects,
        ));
        
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
