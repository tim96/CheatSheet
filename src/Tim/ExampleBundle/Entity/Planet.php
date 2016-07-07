<?php

namespace Tim\ExampleBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Planet
 *
 * @ORM\Table(name="planet")
 * @ORM\Entity(repositoryClass="Tim\ExampleBundle\Repository\PlanetRepository")
 */
class Planet
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
     * @ORM\Column(name="planet_name", type="string", nullable=false, unique=true)
     */
    protected $planetName;

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
     * @ORM\OneToMany(targetEntity="Tim\ExampleBundle\Entity\Country", mappedBy="planet")
     */
    private $countries;

    public function __construct()
    {
        $this->isPublic = false;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->planetName = null;
        $this->countries = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->id ? (string)$this->planetName : '';
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
     * Set planetName
     *
     * @param string $planetName
     *
     * @return Planet
     */
    public function setPlanetName($planetName)
    {
        $this->planetName = $planetName;
    
        return $this;
    }

    /**
     * Get planetName
     *
     * @return string
     */
    public function getPlanetName()
    {
        return $this->planetName;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Planet
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
     * @return Planet
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
     * @return Planet
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
     * Add country
     *
     * @param \Tim\ExampleBundle\Entity\Country $country
     *
     * @return Planet
     */
    public function addCountry(\Tim\ExampleBundle\Entity\Country $country)
    {
        $country->setPlanet($this);

        $this->countries[] = $country;
    
        return $this;
    }

    /**
     * Remove country
     *
     * @param \Tim\ExampleBundle\Entity\Country $country
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCountry(\Tim\ExampleBundle\Entity\Country $country)
    {
        return $this->countries->removeElement($country);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCountries()
    {
        return $this->countries;
    }
}
