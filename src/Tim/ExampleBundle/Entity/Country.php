<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="country_name", type="string", nullable=false, unique=true)
     */
    protected $countryName;

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
     * @ORM\ManyToOne(targetEntity="Tim\ExampleBundle\Entity\Planet", inversedBy="countries", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="planet_id", referencedColumnName="id", nullable=false)
     */
    private $planet;

    /**
     * @ORM\OneToMany(targetEntity="Tim\ExampleBundle\Entity\City", mappedBy="country")
     */
    private $cities;

    public function __construct()
    {
        $this->isPublic = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->countryName = null;
        $this->planet = null;
        $this->cities = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id ? (string)$this->countryName : '';
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
     * Set countryName
     *
     * @param string $countryName
     *
     * @return Country
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;
    
        return $this;
    }

    /**
     * Get countryName
     *
     * @return string
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * Set planet
     *
     * @param \Tim\ExampleBundle\Entity\Planet $planet
     *
     * @return Country
     */
    public function setPlanet(\Tim\ExampleBundle\Entity\Planet $planet)
    {
        $this->planet = $planet;
    
        return $this;
    }

    /**
     * Get planet
     *
     * @return \Tim\ExampleBundle\Entity\Planet
     */
    public function getPlanet()
    {
        return $this->planet;
    }

    /**
     * Add city
     *
     * @param \Tim\ExampleBundle\Entity\City $city
     *
     * @return Country
     */
    public function addCity(\Tim\ExampleBundle\Entity\City $city)
    {
        $city->setCountry($this);

        $this->cities[] = $city;
    
        return $this;
    }

    /**
     * Remove city
     *
     * @param \Tim\ExampleBundle\Entity\City $city
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCity(\Tim\ExampleBundle\Entity\City $city)
    {
        return $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }
}
