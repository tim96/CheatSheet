<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Tim\ExampleBundle\Interfaces\CreatedAtEntityInterface;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\OrdersRepository")
 * @ORM\HasLifecycleCallbacks
 *
 */
class Orders implements CreatedAtEntityInterface
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     **/
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     **/
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_approved", type="boolean", options={"default": false})
     **/
    private $isApproved;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="shipping_address", type="text")
     */
    protected $shippingAddress;

    /**
     * @ORM\ManyToMany(targetEntity="Tim\ExampleBundle\Entity\Discounts", inversedBy="orders")
     **/
    private $discounts;

    /**
     * @ORM\OneToMany(targetEntity="Tim\ExampleBundle\Entity\OrdersDiscountExtraFields",
     *     mappedBy="order", cascade={"persist"})
     */
    private $ordersDicounts;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = null;
        $this->isApproved = false;
        $this->discounts = new ArrayCollection();
        $this->ordersDicounts = new ArrayCollection();
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Orders
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
     * @return Orders
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
     * @ORM\prePersist
     */
    public function setCreatedAtEvent()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtEvent()
    {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Set isApproved
     *
     * @param bool $isApproved
     *
     * @return Orders
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
    
        return $this;
    }

    /**
     * Get isApproved
     *
     * @return bool
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set shippingAddress
     *
     * @param string $shippingAddress
     *
     * @return Orders
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    
        return $this;
    }

    /**
     * Get shippingAddress
     *
     * @return string
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * Add discount
     *
     * @param \Tim\ExampleBundle\Entity\Discounts $discount
     *
     * @return Orders
     */
    public function addDiscount(\Tim\ExampleBundle\Entity\Discounts $discount)
    {
        $discount->addOrder($this);
        $this->discounts[] = $discount;
    
        return $this;
    }

    /**
     * Remove discount
     *
     * @param \Tim\ExampleBundle\Entity\Discounts $discount
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDiscount(\Tim\ExampleBundle\Entity\Discounts $discount)
    {
        return $this->discounts->removeElement($discount);
    }

    /**
     * Get discounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * Add ordersDicount
     *
     * @param \Tim\ExampleBundle\Entity\OrdersDiscountExtraFields $ordersDicount
     *
     * @return Orders
     */
    public function addOrdersDicount(\Tim\ExampleBundle\Entity\OrdersDiscountExtraFields $ordersDicount)
    {
        $this->ordersDicounts[] = $ordersDicount;
    
        return $this;
    }

    /**
     * Remove ordersDicount
     *
     * @param \Tim\ExampleBundle\Entity\OrdersDiscountExtraFields $ordersDicount
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrdersDicount(\Tim\ExampleBundle\Entity\OrdersDiscountExtraFields $ordersDicount)
    {
        return $this->ordersDicounts->removeElement($ordersDicount);
    }

    /**
     * Get ordersDicounts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrdersDicounts()
    {
        return $this->ordersDicounts;
    }
}
