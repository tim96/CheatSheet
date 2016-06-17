<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

// This is an emulation many-to-many relation with extra fields using many-to-one relation

/**
 * OrdersDiscountExtraFields
 *
 * @ORM\Table(name="orders_discount_extra_fields")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\OrdersDiscountExtraFieldsRepository")
 */
class OrdersDiscountExtraFields
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
     * @var int
     *
     * @Assert\Range(min = 0)
     *
     * @ORM\Column(name="sequence", type="integer")
     */
    private $sequence;

    /**
     * @var int
     *
     * @ORM\Column(name="sum", type="integer")
     */
    private $sum;

    /**
     * @var int
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity="Tim\ExampleBundle\Entity\Orders", inversedBy="ordersDicounts")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false)
     */
    private $order;

    /**
     * @ORM\ManyToOne(targetEntity="Tim\ExampleBundle\Entity\Discounts", inversedBy="discountsOrders")
     * @ORM\JoinColumn(name="discount_id", referencedColumnName="id", nullable=false)
     */
    private $discount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     **/
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->sequence = 0;
        $this->priority = 1;
        $this->sum = 0;
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
     * Set sequence
     *
     * @param int $sequence
     *
     * @return OrdersDiscountExtraFields
     */
    public function setSequence($sequence)
    {
        $this->sequence = $sequence;
    
        return $this;
    }

    /**
     * Get sequence
     *
     * @return int
     */
    public function getSequence()
    {
        return $this->sequence;
    }

    /**
     * Set sum
     *
     * @param int $sum
     *
     * @return OrdersDiscountExtraFields
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    
        return $this;
    }

    /**
     * Get sum
     *
     * @return int
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return OrdersDiscountExtraFields
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return OrdersDiscountExtraFields
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
     * Set order
     *
     * @param \Tim\ExampleBundle\Entity\Orders $order
     *
     * @return OrdersDiscountExtraFields
     */
    public function setOrder(\Tim\ExampleBundle\Entity\Orders $order)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return \Tim\ExampleBundle\Entity\Orders
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set discount
     *
     * @param \Tim\ExampleBundle\Entity\Discounts $discount
     *
     * @return OrdersDiscountExtraFields
     */
    public function setDiscount(\Tim\ExampleBundle\Entity\Discounts $discount)
    {
        $this->discount = $discount;
    
        return $this;
    }

    /**
     * Get discount
     *
     * @return \Tim\ExampleBundle\Entity\Discounts
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
