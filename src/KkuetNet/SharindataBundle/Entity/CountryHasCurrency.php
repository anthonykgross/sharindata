<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryHasCurrency
 *
 * @ORM\Table(name="Country_has_Currency" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"country_id", "currency_id"})})
 * @ORM\Entity
 */
class CountryHasCurrency
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
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="countryHasCurrencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $country;

    /**
     * @var \Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency", inversedBy="countryHasCurrencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $currency;
    
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
     * Set country
     *
     * @param \KkuetNet\SharindataBundle\Entity\Country $country
     * @return CountryHasCurrency
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

    /**
     * Set currency
     *
     * @param \KkuetNet\SharindataBundle\Entity\Currency $currency
     * @return CountryHasCurrency
     */
    public function setCurrency(\KkuetNet\SharindataBundle\Entity\Currency $currency)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return \KkuetNet\SharindataBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}