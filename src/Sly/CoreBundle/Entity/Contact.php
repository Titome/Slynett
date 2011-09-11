<?php

namespace Sly\CoreBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    protected $name;
    /**
     * @Assert\NotBlank()
     * @Assert\Email
     */
    protected $email;

    protected $twitter;
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    protected $subject;
    /**
     * @Assert\NotBlank()
     */
    protected $message;
    /**
     * @Assert\Blank()
     */
    protected $mlkqsd;
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }
    
    public function getTwitter()
    {
        return $this->twitter;
    }
    
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }
    
    public function getSubject()
    {
        return $this->subject;
    }
    
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    public function getMessage()
    {
        return $this->message;
    }
}