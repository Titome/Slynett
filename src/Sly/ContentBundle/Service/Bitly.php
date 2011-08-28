<?php

namespace Sly\ContentBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;

class Bitly
{
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    protected function getApiShortenUrl($longUrl, $format = 'json')
    {
        return sprintf(
            'http://api.bitly.com/v3/shorten?login=%s&apiKey=%s&longUrl=%s&format=%s',
            $this->container->getParameter('bitly_username'),
            $this->container->getParameter('bitly_apikey'),
            $longUrl,
            $format
        );
    }
    
    public function generateMinilink($link)
    {        
        $apiLink = $this->getApiShortenUrl($link);
        
        $bitlyResult = json_decode(@file_get_contents($apiLink));
        
        if ($bitlyResult->status_code == 200)
            return $bitlyResult;
        elseif ($bitlyResult->status_code == 500)
            throw new AuthenticationServiceException('Bit.ly authentication failed.');
        else
            throw new AuthenticationServiceException('Bit.ly API error has been encountered.');
    }
}