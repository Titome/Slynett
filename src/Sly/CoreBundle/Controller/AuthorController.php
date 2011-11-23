<?php

namespace Sly\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AuthorController extends Controller
{
    public function indexAction()
    {
        $trans = $this->get('translator');
        
        $portfolioItems = array(
            array(
                'type' => 'perso', 'url' => 'http://socontest.com', 'title' => 'SoContest', 'picture' => 'socontest.png',
                'description' => $trans->trans('portfolio.items.socontest.description', array(), 'author'),
                'tech' => array('PHP5', 'symfony 1.4', 'jQuery', 'CSS', 'Twitter API', 'Facebook API Graph'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.france-terre-asile.org', 'title' => 'France Terre d\'Asile', 'picture' => 'france-terre-asile.png',
                'description' => $trans->trans('portfolio.items.ftda.description', array(), 'author'),
                'tech' => array('Joomla'),
            ),
            array(
                'type' => 'perso', 'url' => 'http://www.goog.la', 'title' => 'Goog.la', 'picture' => 'googla.png',
                'description' => $trans->trans('portfolio.items.googla.description', array(), 'author'),
                'tech' => array('PHP5', 'symfony 1.4', 'Doctrine', 'jQuery', 'Google Plus', 'Google Charts API'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.maxhavelaarfrance.com', 'title' => 'Max Havelaar France', 'picture' => 'max-havelaar.png',
                'description' => $trans->trans('portfolio.items.maxh.description', array(), 'author'),
                'tech' => array('Spip'),
            ),
        );
        
        return $this->render('SlyCoreBundle:Author:index.html.twig', array(
            'portfolioItems' => $portfolioItems,
        ));
    }
    
}
