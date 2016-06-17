<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Discounts
 *
 * @ORM\Table(name="discounts")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\DiscountsRepository")
 */
class Discounts
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
     * @ORM\Column(name="text", type="string", nullable=true)
     */
    protected $text;

    /**
     * @var float
     *
     * @Assert\Range(min = 0)
     *
     * @ORM\Column(name="sum", type="float")
     */
    private $sum;

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
     * @ORM\ManyToMany(targetEntity="Tim\ExampleBundle\Entity\Orders", mappedBy="discounts")
     **/
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="Tim\ExampleBundle\Entity\OrdersDiscountExtraFields",
     *     mappedBy="discount", cascade={"persist"})
     */
    private $discountsOrders;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = null;
        $this->discounts = new ArrayCollection();
        $this->discountsOrders = new ArrayCollection();
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
     * Set text
     *
     * @param string $text
     *
     * @return Discounts
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
     * Set sum
     *
     * @param float $sum
     *
     * @return Discounts
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    
        return $this;
    }

    /**
     * Get sum
     *
     * @return float
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Discounts
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
     * @return Discounts
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
     * Add order
     *
     * @param \Tim\ExampleBundle\Entity\Orders $order
     *
     * @return Discounts
     */
    public function addOrder(\Tim\ExampleBundle\Entity\Orders $order)
    {
        // 'by_reference' => false on the corresponding form fields.
        $order->addDiscount($this);
        $this->orders[] = $order;
    
        return $this;
    }

    /**
     * Remove order
     *
     * @param \Tim\ExampleBundle\Entity\Orders $order
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrder(\Tim\ExampleBundle\Entity\Orders $order)
    {
        return $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
