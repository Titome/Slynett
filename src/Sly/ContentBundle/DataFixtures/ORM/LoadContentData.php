<?php

namespace Sly\ContentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Sly\ContentBundle\Entity\Category;
use Sly\ContentBundle\Entity\Content;

class LoadContentData implements FixtureInterface
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
            $content->setTags('test1 test2 test3');

            $manager->persist($content);
        }

        /**
         * Load Watch content...
         */
        
        for ($i = 1; $i <= 40; $i++)
        {
            $content = new Content();
            $content->setType('watch');
            $content->setCategories(array($cat[rand(0, 2)], $cat[rand(3, 5)]));
            $content->setTitle(sprintf('This is watch link (number %d)', $i));
            $content->setLink(sprintf('http://www.test.com?test%d', $i));
            $content->setMinilink(sprintf('http://t.mx/a1b2c%d', $i));
            $content->setTags('test1 test2 test3');

            $manager->persist($content);
        }

        /**
         * Load Video Tutorial content...
         */
        
        for ($i = 1; $i <= 40; $i++)
        {
            $content = new Content();
            $content->setType('tutorial');
            $content->setCategories(array($cat[rand(0, 5)]));
            $content->setTitle('Lorem ipsum dolor sit amet, consectetur adipisicing elit');
            $content->setExcerpt('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
            $content->setLink('http://www.dailymotion.com/video/xgsf9_the-police-roxane_music');

            $manager->persist($content);
        }
        
        /**
         * Load Snippet content...
         */
        
        for ($i = 1; $i <= 40; $i++)
        {
            $content = new Content();
            $content->setType('snippet');
            $content->setCategories(array($cat[rand(0, 2)], $cat[rand(3, 5)]));
            $content->setTitle(sprintf('This is a snippet (number %d)', $i));
            $content->setExcerpt('Snippet description.');
            $content->setGistId('1176979');

            $manager->persist($content);
        }
        
        /**
         * Load some fake tweets - if needed
         */
        
        /* for ($i = 1; $i <= 70; $i++)
        {
            $content = new Content();
            $content->setType('twitter');
            $content->setTitle(sprintf('Fake tweet number %d', $i));
            $content->setSocialNetworkId('1234567890123456');

            $manager->persist($content);
        } */
        
        /**
         * Just do it, with magic!
         */
        
        $manager->flush();
        
        /**
         * Change content publishedAt datetimes
         */
        
        $content = $manager->getRepository('SlyContentBundle:Content')->findAll();
        
        foreach ($content as $c)
        {
            $c->setPublishedAt(new \DateTime(date('Y-m-d H:i:s', rand((1315496965 - 100000), 1315496965))));
            
            $manager->persist($c);
        }
        
        $manager->flush();
    }
}