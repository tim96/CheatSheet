<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PostType
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Entity\PostTypeRepository")
 */
class PostType
{
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->isDeleted = false;
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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="icon_name", type="string", length=255)
     */
    protected $iconName;

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
     * @ORM\OneToMany(targetEntity="Post", mappedBy="postType")
     */
    private $post;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id ? (string)$this->name : '';
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
     * Set name
     *
     * @param string $name
     *
     * @return PostType
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return PostType
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
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return PostType
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
     * Get datetime on timestamp
     * @return int|null
     */
    public function getCreatedAtTimestamp()
    {
        return $this->createdAt ? $this->createdAt->getTimestamp() : null;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return PostType
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
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     *
     * @return PostType
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
     * Set post
     *
     * @param \Tim\CheatSheetBundle\Entity\Post $post
     *
     * @return PostType
     */
    public function setPost(\Tim\CheatSheetBundle\Entity\Post $post = null)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \Tim\CheatSheetBundle\Entity\Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set iconName
     *
     * @param string $iconName
     *
     * @return PostType
     */
    public function setIconName($iconName)
    {
        $this->iconName = $iconName;
    
        return $this;
    }

    /**
     * Get iconName
     *
     * @return string
     */
    public function getIconName()
    {
        return $this->iconName;
    }

    /**
     * Add post
     *
     * @param \Tim\CheatSheetBundle\Entity\Post $post
     *
     * @return PostType
     */
    public function addPost(\Tim\CheatSheetBundle\Entity\Post $post)
    {
        $this->post[] = $post;
    
        return $this;
    }

    /**
     * Remove post
     *
     * @param \Tim\CheatSheetBundle\Entity\Post $post
     */
    public function removePost(\Tim\CheatSheetBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return PostType
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    public static function getPriorityList()
    {
        return range(0, 10);
    }
}
