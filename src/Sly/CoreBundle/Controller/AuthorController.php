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
                'type' => 'perso', 'url' => 'http://www.slynett.com', 'title' => 'Slynett Labs', 'picture' => 'slynett-labs.png',
                'description' => $trans->trans('portfolio.items.slynettlabs.description', array(), 'author'),
                'tech' => array('PHP5', 'Symfony2', 'Doctrine', 'jQuery', 'jQuery UI', 'HTML5', 'CSS3', 'Twitter API'),
            ),
            array(
                'type' => 'perso', 'url' => 'http://socontest.com', 'title' => 'SoContest', 'picture' => 'socontest.png',
                'description' => $trans->trans('portfolio.items.socontest.description', array(), 'author'),
                'tech' => array('PHP5', 'symfony 1.4', 'Doctrine', 'jQuery', 'CSS', 'Twitter API', 'Facebook API Graph'),
            ),
            array(
                'type' => 'perso', 'url' => 'http://www.goog.la', 'title' => 'Goog.la', 'picture' => 'googla.png',
                'description' => $trans->trans('portfolio.items.googla.description', array(), 'author'),
                'tech' => array('PHP5', 'symfony 1.4', 'Doctrine', 'jQuery', 'Google Plus', 'Google Charts API'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.france-terre-asile.org', 'title' => 'France Terre d\'Asile', 'picture' => 'france-terre-asile.png',
                'description' => $trans->trans('portfolio.items.ftda.description', array(), 'author'),
                'tech' => array('Joomla', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.france-terre-asile.org', 'title' => 'France Terre d\'Asile (applications Web)', 'picture' => 'ftda-plateforme.png',
                'description' => $trans->trans('portfolio.items.ftdaapps.description', array(), 'author'),
                'tech' => array('symfony 1.4', 'Doctrine', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.maxhavelaarfrance.com', 'title' => 'Max Havelaar France', 'picture' => 'max-havelaar.png',
                'description' => $trans->trans('portfolio.items.maxh.description', array(), 'author'),
                'tech' => array('SPIP', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.exa-int.com', 'title' => 'Exa International', 'picture' => 'exa-international.png',
                'description' => $trans->trans('portfolio.items.exaint.description', array(), 'author'),
                'tech' => array('Joomla', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.pretdhonneur.com', 'title' => 'Rhône-Alpes Initiative', 'picture' => 'rhone-alpes-initiative.png',
                'description' => $trans->trans('portfolio.items.rai.description', array(), 'author'),
                'tech' => array('Joomla', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.socook.net', 'title' => 'SoCook', 'picture' => 'socook.png',
                'description' => $trans->trans('portfolio.items.socook.description', array(), 'author'),
                'tech' => array('WordPress', 'jQuery'),
            ),
            array(
                'type' => 'perso', 'url' => 'http://www.magicien-closeup.net', 'title' => 'Magicien-CloseUp.net', 'picture' => 'magicien-closeup.png',
                'description' => $trans->trans('portfolio.items.magiciencloseup.description', array(), 'author'),
                'tech' => array('WordPress', 'jQuery'),
            ),
            array(
                'type' => 'pro', 'url' => 'http://www.domaineceserac.fr', 'title' => 'Domaine de Céserac', 'picture' => 'domaine-ceserac.png',
                'description' => $trans->trans('portfolio.items.domaineceserac.description', array(), 'author'),
                'tech' => array('WordPress', 'jQuery'),
            ),
            array(
                'type' => 'perso', 'url' => 'http://www.twcontest.net', 'title' => 'twContest', 'picture' => 'twcontest.jpg',
                'description' => $trans->trans('portfolio.items.rai.description', array(), 'author'),
                'tech' => array('symfony 1.4', 'Doctrine', 'jQuery', 'Twitter API', 'Facebook API Graph'),
            ),
            array(
                'type' => 'pro', 'disabled' => true, 'url' => 'http://www.slynett.com', 'title' => 'Slynett Agency', 'picture' => 'slynett-agency.png',
                'description' => $trans->trans('portfolio.items.slynettagency.description', array(), 'author'),
                'tech' => array('WordPress', 'jQuery'),
            ),
        );
        
        return $this->render('SlyCoreBundle:Author:index.html.twig', array(
            'portfolioItems' => $portfolioItems,
        ));
    }
    
}
