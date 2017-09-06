<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tax
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tax
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="decimal", scale=3, precision=10)
     */
    private $rate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32)
     */
    private $name;


    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="taxes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $country;
    
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
     * Set rate
     *
     * @param float $rate
     * @return Tax
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tax
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
     * Set country
     *
     * @param \KkuetNet\SharindataBundle\Entity\Country $country
     * @return Tax
     */
    public function setCountry(\KkuetNet\SharindataBundle\Entity\Country $country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \KkuetNet\SharindataBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}