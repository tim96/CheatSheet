<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\CityRepository")
 */
class City
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
     * @ORM\Column(name="city_name", type="string", nullable=false, unique=true)
     */
    protected $cityName;

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
     * @ORM\Column(name="is_public", type="boolean", options={"default": false})
     **/
    private $isPublic;

    /**
     * @ORM\ManyToOne(targetEntity="Tim\ExampleBundle\Entity\Country", inversedBy="cities", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    private $country;

    public function __construct()
    {
        $this->isPublic = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->cityName = null;
        $this->planet = null;
    }

    public function __toString()
    {
        return $this->id ? (string)$this->cityName : '';
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
     * Set cityName
     *
     * @param string $cityName
     *
     * @return City
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    
        return $this;
    }

    /**
     * Get cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return City
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
     * @return City
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
     * Set isPublic
     *
     * @param bool $isPublic
     *
     * @return City
     */
    public function setIsPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    
        return $this;
    }

    /**
     * Get isPublic
     *
     * @return bool
     */
    public function getIsPublic()
    {
        return $this->isPublic;
    }

    /**
     * Set country
     *
     * @param \Tim\ExampleBundle\Entity\Country $country
     *
     * @return City
     */
    public function setCountry(\Tim\ExampleBundle\Entity\Country $country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Tim\ExampleBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }
}
