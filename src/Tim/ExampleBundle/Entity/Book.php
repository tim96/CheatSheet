<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\BookRepository")
 */
class Book
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
     * @Assert\NotBlank()
     * @Assert\NotNull()
     *
     * @ORM\Column(name="title", type="string")
     */
    protected $title;

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
     * @ORM\Column(name="is_sold", type="boolean", options={"default": false})
     **/
    private $isSold;

    /**
     * @var float
     *
     * @Assert\Range(min = 0)
     *
     * @ORM\Column(name="price", type="float", options={"default": 0})
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="count_sold", type="integer", options={"default": 0})
     */
    private $countSold;

    /**
     * @var int
     *
     * @ORM\Column(name="count_stock", type="integer", options={"default": 0})
     */
    private $countStock;

    /**
     * @var float
     *
     * @Assert\Range(min = 0)
     *
     * @ORM\Column(name="price_tax", type="float", options={"default": 0})
     */
    private $priceTax;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isSold = false;
        $this->price = 0;
        $this->priceTax = 0;
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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Book
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
     * @return Book
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
     * @return Book
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
     * Set isSold
     *
     * @param bool $isSold
     *
     * @return Book
     */
    public function setIsSold($isSold)
    {
        $this->isSold = $isSold;
    
        return $this;
    }

    /**
     * Get isSold
     *
     * @return bool
     */
    public function getIsSold()
    {
        return $this->isSold;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set countSold
     *
     * @param int $countSold
     *
     * @return Book
     */
    public function setCountSold($countSold)
    {
        $this->countSold = $countSold;
    
        return $this;
    }

    /**
     * Get countSold
     *
     * @return int
     */
    public function getCountSold()
    {
        return $this->countSold;
    }

    /**
     * Set countStock
     *
     * @param int $countStock
     *
     * @return Book
     */
    public function setCountStock($countStock)
    {
        $this->countStock = $countStock;
    
        return $this;
    }

    /**
     * Get countStock
     *
     * @return int
     */
    public function getCountStock()
    {
        return $this->countStock;
    }

    /**
     * Set priceTax
     *
     * @param float $priceTax
     *
     * @return Book
     */
    public function setPriceTax($priceTax)
    {
        $this->priceTax = $priceTax;
    
        return $this;
    }

    /**
     * Get priceTax
     *
     * @return float
     */
    public function getPriceTax()
    {
        return $this->priceTax;
    }
}
