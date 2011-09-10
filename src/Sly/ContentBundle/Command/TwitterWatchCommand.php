<?php

namespace Sly\ContentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Sly\ContentBundle\Entity\Content;

class TwitterWatchCommand extends ContainerAwareCommand
{
    protected function configure()
    {   
         $this->setName('watch:twitter')
                ->setDescription('Get Twitter watch from CRON.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $twitter = $this->getContainer()->get('sly.twitter');
        
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        
        $lastTweet = $em->getRepository('SlyContentBundle:Content')->findOneBy(
            array('type' => 'twitter'),
            array('social_network_id' => 'DESC')
        );
        
        $twitter->setLastTweetId($lastTweet?$lastTweet->getSocialNetworkId():null);
        
        foreach ($twitter->getTweets() as $t)
        {
            $content = new Content();
            $content->setType('twitter');
            $content->setTitle($t->text);
            $content->setSocialNetworkId($t->id);

            $em->persist($content);
            
            $output->writeln(sprintf('[ADDED] %s - %s',
                $t->created_at,
                $t->text
            ));
        }
        
        $em->flush();
        
        $output->writeln('Done. Be happy. :)');
    }
}