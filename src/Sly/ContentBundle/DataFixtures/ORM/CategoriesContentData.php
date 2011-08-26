<?php

namespace Sly\ContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Sly\ContentBundle\Entity\Category;
use Sly\ContentBundle\Entity\Content;

class LoadPostData implements FixtureInterface
{
    public function load($manager)
    {
        /**
         * Load main categories.
         */
        
        $categories = array('PHP5', 'symfony 1.4', 'Symfony2', 'jQuery', 'CSS', 'SEO', 'e-Communication', 'Tutoriels', 'Autres', 'Slynett', 'Actualités', 'Découvertes');
        $cat[] = array();
        
        foreach ($categories as $k => $c)
        {
            $cat[$k] = new Category();
            $cat[$k]->setName($c);
            $manager->persist($cat[$k]);
        }
        
        /**
         * Load Blog content...
         */
        
        for ($i = 1; $i <= 20; $i++)
        {
            $content = new Content();
            $content->setType('blog');
            $content->setCategories(array($cat[rand(0, 2)], $cat[rand(3, 5)]));
            $content->setTitle(sprintf('This is a test (number %d)', $i));
            $content->setContent('
<p><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</strong> Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <strong>Ut enim ad minim veniam</strong>, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<p>Lorem ipsum dolor sit amet, <a href="#">consectetur adipisicing elit</a>, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            ');

            $manager->persist($content);
        }
        
        /**
         * Just do it, with magic!
         */
        
        $manager->flush();
    }
}