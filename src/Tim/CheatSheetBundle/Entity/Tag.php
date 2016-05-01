<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Entity\TagRepository")
 */
class Tag
{
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->isDeleted = false;
        $this->feedbacks = new ArrayCollection();
        $this->blogPosts = new ArrayCollection();
        $this->blogPostCount = 0;
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
     * @Assert\NotNull()
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

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
     * @ORM\Column(name="is_deleted", type="boolean", options={"default": false})
     **/
    private $isDeleted = false;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity="Feedback", mappedBy="tags")
     **/
    private $feedbacks;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     **/
    private $posts;

    /**
     * @ORM\ManyToMany(targetEntity="BlogPost", mappedBy="tags", cascade={"persist"})
     **/
    private $blogPosts;

    /**
     * @var int
     *
     * @ORM\Column(name="blog_post_count", type="integer")
     */
    private $blogPostCount;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id ? $this->getName() : '';
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
     * @return Tag
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
     * @return Tag
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
     * @return Tag
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
     * Add feedback
     *
     * @param \Tim\CheatSheetBundle\Entity\Feedback $feedback
     *
     * @return Tag
     */
    public function addFeedback(\Tim\CheatSheetBundle\Entity\Feedback $feedback)
    {
        $this->feedbacks[] = $feedback;
    
        return $this;
    }

    /**
     * Remove feedback
     *
     * @param \Tim\CheatSheetBundle\Entity\Feedback $feedback
     */
    public function removeFeedback(\Tim\CheatSheetBundle\Entity\Feedback $feedback)
    {
        $this->feedbacks->removeElement($feedback);
    }

    /**
     * Get feedbacks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }

    /**
     * Add post
     *
     * @param \Tim\CheatSheetBundle\Entity\Post $post
     *
     * @return Tag
     */
    public function addPost(\Tim\CheatSheetBundle\Entity\Post $post)
    {
        $post->addTag($this);
        $this->posts[] = $post;
    
        return $this;
    }

    /**
     * Remove post
     *
     * @param \Tim\CheatSheetBundle\Entity\Post $post
     */
    public function removePost(\Tim\CheatSheetBundle\Entity\Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Set author
     *
     * @param \Application\Sonata\UserBundle\Entity\User $author
     *
     * @return Tag
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Tag
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
     * Set blogPostCount
     *
     * @param int $blogPostCount
     *
     * @return Tag
     */
    public function setBlogPostCount($blogPostCount)
    {
        $this->blogPostCount = $blogPostCount;
    
        return $this;
    }

    /**
     * Get blogPostCount
     *
     * @return int
     */
    public function getBlogPostCount()
    {
        return $this->blogPostCount;
    }

    /**
     * Add blogPost
     *
     * @param \Tim\CheatSheetBundle\Entity\BlogPost $blogPost
     *
     * @return Tag
     */
    public function addBlogPost(\Tim\CheatSheetBundle\Entity\BlogPost $blogPost)
    {
        $blogPost->addTag($this);
        $this->blogPosts[] = $blogPost;
    
        return $this;
    }

    /**
     * Remove blogPost
     *
     * @param \Tim\CheatSheetBundle\Entity\BlogPost $blogPost
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBlogPost(\Tim\CheatSheetBundle\Entity\BlogPost $blogPost)
    {
        return $this->blogPosts->removeElement($blogPost);
    }

    /**
     * Get blogPosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogPosts()
    {
        return $this->blogPosts;
    }
}
