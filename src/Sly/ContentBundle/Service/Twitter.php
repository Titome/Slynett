<?php

namespace Sly\ContentBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;

class Twitter
{
    protected $container;
    protected $lastTweetId = null;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function setLastTweetId($lastTweetId)
    {
        $this->lastTweetId = $lastTweetId;
    }
    
    protected function getApiUrl()
    {
        if ($this->lastTweetId)
            return sprintf('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=false&include_rts=false&exclude_replies=true&screen_name=%s&count=20&since_id=%s', $this->container->getParameter('sly.twitter.username'), $lastTweetId);
        else
            return sprintf('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=false&include_rts=false&exclude_replies=true&screen_name=%s&count=20', $this->container->getParameter('sly.twitter.username'));
    }
    
    public function getTweets()
    {
        $jsonImport = @file_get_contents($this->getApiUrl($lastTweetId)); 
        
        return json_decode($jsonImport);
    }
}