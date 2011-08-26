<?php

namespace Sly\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Sly\ContentBundle\Entity\CategoryRepository")
 * @ORM\Table(name="content_categories")
 * @ORM\HasLifecycleCallbacks
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @Assert\Type("boolean")
     * @ORM\Column(type="boolean")
     */
    protected $status;
    /**
     * @Gedmo\Sluggable
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $name;
    /**
     * @Gedmo\Slug
     * @ORM\Column(type="string", length=255)
     */
    protected $slug;
    /**
     * @ORM\ManyToMany(targetEntity="Content", mappedBy="categories")
     */
    protected $content;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function __toString()
    {
        return $this->name;
    }
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->status = true;
    }
}