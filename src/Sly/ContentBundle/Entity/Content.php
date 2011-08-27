<?php

namespace Sly\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Sly\ContentBundle\Entity\ContentRepository")
 * @ORM\Table(name="content")
 * @ORM\HasLifecycleCallbacks
 */
class Content
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
     * @ORM\Column(type="string", length=20)
     */
    protected $type;
    /**
     * @Gedmo\Sluggable
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    protected $title;
    /**
     * @Gedmo\Slug
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $slug;
    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text", nullable=true)
     */
    protected $content;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $excerpt;
    /**
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $link;
    /**
     * @Assert\Url()
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $videoUrl;
    /**
     * @Assert\File(maxSize="6000000")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;
    /**
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", name="published_at")
     */
    protected $publishedAt;
    /**
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;
    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="posts")
     * @ORM\JoinTable(name="content_categories_attrib")
     */
    protected $categories;

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
    
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getType()
    {
        return $this->type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {        
        $this->title = $title;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    }
    
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    
    public function setLink($link)
    {
        $this->link = $link;
    }
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }
    
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }
    
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
 
    public function getPicture()
    {
        return $this->picture;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
    }
    
    public function __toString()
    {
        return $this->title;
    }
    
    public function getFullPicturePath()
    {
        return null === $this->picture ? null : $this->getUploadRootDir(). $this->picture;
    }

    protected function getUploadRootDir()
    {
        return $this->getTmpUploadRootDir().$this->getId()."/";
    }

    protected function getTmpUploadRootDir()
    {
        return __DIR__ . '/../../../../web/uploads/posts/';
    }
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->publishedAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->status = true;
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadPicture() {
        if (null === $this->picture)
            return;
        
        if (!$this->id)
            $this->picture->move($this->getTmpUploadRootDir(), $this->picture->getClientOriginalName());
        else
            $this->picture->move($this->getUploadRootDir(), $this->picture->getClientOriginalName());
        
        $this->setPicture($this->picture->getClientOriginalName());
    }
    
    /**
     * @ORM\PostPersist()
     */
    public function movePicture()
    {
        if (null === $this->picture)
            return;
        
        if(!is_dir($this->getUploadRootDir()))
            mkdir($this->getUploadRootDir());

        copy($this->getTmpUploadRootDir().$this->picture, $this->getFullPicturePath());
        unlink($this->getTmpUploadRootDir().$this->picture);
    }

    /**
     * @ORM\PreRemove()
     */
    public function removePicture()
    {
        unlink($this->getFullPicturePath());
        rmdir($this->getUploadRootDir());
    }
}