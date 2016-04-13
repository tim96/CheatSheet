<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * BlogPost
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Entity\BlogPostRepository")
 */
class BlogPost
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="meta", type="text", nullable=true)
     */
    protected $meta;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="text", type="string", length=255)
     */
    protected $text;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="intro", type="text")
     */
    protected $intro;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(name="created_at", type="datetime")
     **/
    private $createdAt;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     **/
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\Column(name="is_publish", type="boolean", options={"default": false})
     **/
    private $isPublish = false;

    /**
     * @ORM\Column(name="is_deleted", type="boolean", options={"default": false})
     **/
    private $isDeleted = false;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="blogPosts")
     * @ORM\JoinTable(name="blog_post_tag")
     **/
    private $tags;

    public function __construct()
    {
        $this->isDeleted = false;
        $this->isPublish = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->tags = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id ? (string)$this->id : '';
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set meta
     *
     * @param string $meta
     *
     * @return BlogPost
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
    
        return $this;
    }

    /**
     * Get meta
     *
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return BlogPost
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return BlogPost
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return BlogPost
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return BlogPost
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isDeleted
     *
     * @param bool $isDeleted
     *
     * @return BlogPost
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    
        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return bool
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     *
     * @return BlogPost
     */
    public function setAuthor(\Application\Sonata\UserBundle\Entity\User $author = null)
    {
        $this->author = $author;
    
        return $this;
    }

    /**
     * Get author
     *
     * @return \Application\Sonata\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set isPublish
     *
     * @param bool $isPublish
     *
     * @return BlogPost
     */
    public function setIsPublish($isPublish)
    {
        $this->isPublish = $isPublish;
    
        return $this;
    }

    /**
     * Get isPublish
     *
     * @return bool
     */
    public function getIsPublish()
    {
        return $this->isPublish;
    }

    /**
     * Add tag
     *
     * @param \Tim\CheatSheetBundle\Entity\Tag $tag
     *
     * @return BlogPost
     */
    public function addTag(\Tim\CheatSheetBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;
    
        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Tim\CheatSheetBundle\Entity\Tag $tag
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTag(\Tim\CheatSheetBundle\Entity\Tag $tag)
    {
        return $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set intro
     *
     * @param string $intro
     *
     * @return BlogPost
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;
    
        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }
}
