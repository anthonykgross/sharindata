<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tax
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class State
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
     * @ORM\Column(name="tax_behavior", type="boolean")
     */
    private $tax_behavior;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;


    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", length=7)
     */
    private $iso;
    
    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="states")
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
     * Set tax_behavior
     *
     * @param boolean $taxBehavior
     * @return State
     */
    public function setTaxBehavior($taxBehavior)
    {
        $this->tax_behavior = $taxBehavior;
    
        return $this;
    }

    /**
     * Get tax_behavior
     *
     * @return boolean 
     */
    public function getTaxBehavior()
    {
        return $this->tax_behavior;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return State
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
     * Set iso
     *
     * @param string $iso
     * @return State
     */
    public function setIso($iso)
    {
        $this->iso = $iso;
    
        return $this;
    }

    /**
     * Get iso
     *
     * @return string 
     */
    public function getIso()
    {
        return $this->iso;
    }

    /**
     * Set country
     *
     * @param \KkuetNet\SharindataBundle\Entity\Country $country
     * @return State
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