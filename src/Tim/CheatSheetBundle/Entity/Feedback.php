<?php

namespace Tim\CheatSheetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
// use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Doctrine\Common\Collections\ArrayCollection;

// Help information:
// @ExclusionPolicy(“all”) : Every field on your entity will be ignore while serializing.
// @Expose : This field will be serialized
// @VirtualProperty : This method will be called and serialized as a virtual property. (used_name in our example)

/**
 * Feedback
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Tim\CheatSheetBundle\Entity\FeedbackRepository")
 *
 * @ExclusionPolicy("all")
 */
class Feedback
{
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->isAnswered = false;
        $this->isDeleted = false;
        $this->tags = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false
     * )
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @Expose
     */
    private $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Expose
     */
    protected $name;

    /**
     *
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="message", type="text")
     *
     * @Expose
     */
    protected $message;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     *
     * @ORM\Column(name="created_at", type="datetime")
     **/
    private $createdAt;

    /**
     * @ORM\Column(name="is_answered", type="boolean", options={"default": false})
     **/
    private $isAnswered = false;

    /**
     * @ORM\Column(name="is_deleted", type="boolean", options={"default": false})
     **/
    private $isDeleted = false;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="feedbacks")
     * @ORM\JoinTable(name="feedback_tag")
     **/
    private $tags;

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
     * Set email
     *
     * @param string $email
     *
     * @return Feedback
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Feedback
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
     * Set message
     *
     * @param string $message
     *
     * @return Feedback
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Feedback
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
     * Set isAnswered
     *
     * @param boolean $isAnswered
     *
     * @return Feedback
     */
    public function setIsAnswered($isAnswered)
    {
        $this->isAnswered = $isAnswered;
    
        return $this;
    }

    /**
     * Get isAnswered
     *
     * @return boolean
     */
    public function getIsAnswered()
    {
        return $this->isAnswered;
    }

    /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     *
     * @return Feedback
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
     *
     * @return int|null
     * @VirtualProperty
     */
    public function getCreatedAtTimestamp()
    {
        return $this->createdAt ? $this->createdAt->getTimestamp() : null;
    }

    /**
     * Add tag
     *
     * @param \Tim\CheatSheetBundle\Entity\Tag $tag
     *
     * @return Feedback
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
}
