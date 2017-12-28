<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table(name="Currency")
 * @ORM\Entity
 */
class Currency
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=32)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code", type="string", length=3)
     */
    private $isoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code_num", type="string", length=3)
     */
    private $isoCodeNum;

    /**
     * @var string
     *
     * @ORM\Column(name="sign", type="string", length=8)
     */
    private $sign;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blank", type="boolean")
     */
    private $blank;

    /**
     * @var boolean
     *
     * @ORM\Column(name="decimals", type="boolean")
     */
    private $decimals;
    
    /**
     * @var float
     *
     * @ORM\Column(name="conversion_rate", type="decimal", scale=6, precision=13)
     */
    private $conversionRate;


    /**
     * @ORM\OneToMany(targetEntity="CountryHasCurrency", mappedBy="currency", cascade={"remove", "persist"})
     */
    private $countryHasCurrencies;
    
    /**
     * @var \CurrencyFormat
     *
     * @ORM\ManyToOne(targetEntity="CurrencyFormat", inversedBy="currencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currencyFormat_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $currencyFormat;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countryHasCurrencies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     * @return Currency
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
     * Set isoCode
     *
     * @param string $isoCode
     * @return Currency
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;
    
        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string 
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * Set isoCodeNum
     *
     * @param string $isoCodeNum
     * @return Currency
     */
    public function setIsoCodeNum($isoCodeNum)
    {
        $this->isoCodeNum = $isoCodeNum;
    
        return $this;
    }

    /**
     * Get isoCodeNum
     *
     * @return string 
     */
    public function getIsoCodeNum()
    {
        return $this->isoCodeNum;
    }

    /**
     * Set sign
     *
     * @param string $sign
     * @return Currency
     */
    public function setSign($sign)
    {
        $this->sign = $sign;
    
        return $this;
    }

    /**
     * Get sign
     *
     * @return string 
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * Set blank
     *
     * @param boolean $blank
     * @return Currency
     */
    public function setBlank($blank)
    {
        $this->blank = $blank;
    
        return $this;
    }

    /**
     * Get blank
     *
     * @return boolean 
     */
    public function getBlank()
    {
        return $this->blank;
    }

    /**
     * Set conversionRate
     *
     * @param float $conversionRate
     * @return Currency
     */
    public function setConversionRate($conversionRate)
    {
        $this->conversionRate = $conversionRate;
    
        return $this;
    }

    /**
     * Get conversionRate
     *
     * @return float 
     */
    public function getConversionRate()
    {
        return $this->conversionRate;
    }

    /**
     * Add countryHasCurrencies
     *
     * @param \KkuetNet\SharindataBundle\Entity\CountryHasCurrency $countryHasCurrencies
     * @return Currency
     */
    public function addCountryHasCurrencie(\KkuetNet\SharindataBundle\Entity\CountryHasCurrency $countryHasCurrencies)
    {
        $this->countryHasCurrencies[] = $countryHasCurrencies;
    
        return $this;
    }

    /**
     * Remove countryHasCurrencies
     *
     * @param \KkuetNet\SharindataBundle\Entity\CountryHasCurrency $countryHasCurrencies
     */
    public function removeCountryHasCurrencie(\KkuetNet\SharindataBundle\Entity\CountryHasCurrency $countryHasCurrencies)
    {
        $this->countryHasCurrencies->removeElement($countryHasCurrencies);
    }

    /**
     * Get countryHasCurrencies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountryHasCurrencies()
    {
        return $this->countryHasCurrencies;
    }

    /**
     * Set currencyFormat
     *
     * @param \KkuetNet\SharindataBundle\Entity\CurrencyFormat $currencyFormat
     * @return Currency
     */
    public function setCurrencyFormat(\KkuetNet\SharindataBundle\Entity\CurrencyFormat $currencyFormat)
    {
        $this->currencyFormat = $currencyFormat;
    
        return $this;
    }

    /**
     * Get currencyFormat
     *
     * @return \KkuetNet\SharindataBundle\Entity\CurrencyFormat 
     */
    public function getCurrencyFormat()
    {
        return $this->currencyFormat;
    }

    /**
     * Set decimals
     *
     * @param boolean $decimals
     * @return Currency
     */
    public function setDecimals($decimals)
    {
        $this->decimals = $decimals;
    
        return $this;
    }

    /**
     * Get decimals
     *
     * @return boolean 
     */
    public function getDecimals()
    {
        return $this->decimals;
    }
}