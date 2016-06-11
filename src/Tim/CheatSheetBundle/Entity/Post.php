<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Entity\PostRepository")
 */
class Post
{
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->isDeleted = false;
        $this->tags = new ArrayCollection();
        $this->postType = new ArrayCollection();
        $this->meta = null;
        $this->isMain = false;
    }

    /**
     * @var integer
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
     * @ORM\Column(name="is_deleted", type="boolean", options={"default": false})
     **/
    private $isDeleted = false;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(name="post_tag")
     **/
    private $tags;

    /**
     * @Assert\NotNull()
     * @Assert\NotBlank()
     *
     * @ORM\ManyToOne(targetEntity="PostType", inversedBy="post", cascade={"persist", "remove"})
     */
    private $postType;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_main", type="boolean", options={"default": true})
     **/
    private $isMain;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id ? (string)$this->id : '';
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Post
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
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
     * @return Post
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
     * @param boolean $isDeleted
     *
     * @return Post
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    
        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Add tag
     *
     * @param \Tim\CheatSheetBundle\Entity\Tag $tag
     *
     * @return Post
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
     */
    public function removeTag(\Tim\CheatSheetBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
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
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     *
     * @return Post
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
     * Set meta
     *
     * @param string $meta
     *
     * @return Post
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
     * Add postType
     *
     * @param \Tim\CheatSheetBundle\Entity\PostType $postType
     *
     * @return Post
     */
    public function addPostType(\Tim\CheatSheetBundle\Entity\PostType $postType)
    {
        $this->postType[] = $postType;
    
        return $this;
    }

    /**
     * Remove postType
     *
     * @param \Tim\CheatSheetBundle\Entity\PostType $postType
     */
    public function removePostType(\Tim\CheatSheetBundle\Entity\PostType $postType)
    {
        $this->postType->removeElement($postType);
    }

    /**
     * Get postType
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Post
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
     * Set postType
     *
     * @param \Tim\CheatSheetBundle\Entity\PostType $postType
     *
     * @return Post
     */
    public function setPostType(\Tim\CheatSheetBundle\Entity\PostType $postType = null)
    {
        $this->postType = $postType;
    
        return $this;
    }

    /**
     * Set isMain
     *
     * @param bool $isMain
     *
     * @return Post
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
    
        return $this;
    }

    /**
     * Get isMain
     *
     * @return bool
     */
    public function getIsMain()
    {
        return $this->isMain;
    }
}
