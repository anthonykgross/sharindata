<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="Country" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"iso"})})
 * @ORM\Entity
 */
class Country
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
     * @ORM\Column(name="iso", type="string", length=3)
     */
    private $iso;

    /**
     * @var \Zone
     *
     * @ORM\ManyToOne(targetEntity="Zone", inversedBy="countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $zone;
    
    /**
     * @var \Timezone
     *
     * @ORM\ManyToOne(targetEntity="Timezone", inversedBy="countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="timezone_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="call_prefix", type="string", length=5)
     */
    private $callPrefix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="contains_states", type="boolean")
     */
    private $containsStates;

    /**
     * @var boolean
     *
     * @ORM\Column(name="need_identification_number", type="boolean")
     */
    private $needIdentificationNumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="need_zip_code", type="boolean")
     */
    private $needZipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code_format", type="string", length=12)
     */
    private $zipCodeFormat;

    /**
     * @var boolean
     *
     * @ORM\Column(name="display_tax_label", type="boolean")
     */
    private $displayTaxLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="address_format", type="text", nullable=true)
     */
    private $addressFormat;


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
     * Set iso
     *
     * @param string $iso
     * @return Country
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
     * Set zone
     *
     * @param string $zone
     * @return Country
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set callPrefix
     *
     * @param string $callPrefix
     * @return Country
     */
    public function setCallPrefix($callPrefix)
    {
        $this->callPrefix = $callPrefix;
    
        return $this;
    }

    /**
     * Get callPrefix
     *
     * @return string 
     */
    public function getCallPrefix()
    {
        return $this->callPrefix;
    }

    /**
     * Set containsStates
     *
     * @param boolean $containsStates
     * @return Country
     */
    public function setContainsStates($containsStates)
    {
        $this->containsStates = $containsStates;
    
        return $this;
    }

    /**
     * Get containsStates
     *
     * @return boolean 
     */
    public function getContainsStates()
    {
        return $this->containsStates;
    }

    /**
     * Set needIdentificationNumber
     *
     * @param boolean $needIdentificationNumber
     * @return Country
     */
    public function setNeedIdentificationNumber($needIdentificationNumber)
    {
        $this->needIdentificationNumber = $needIdentificationNumber;
    
        return $this;
    }

    /**
     * Get needIdentificationNumber
     *
     * @return boolean 
     */
    public function getNeedIdentificationNumber()
    {
        return $this->needIdentificationNumber;
    }

    /**
     * Set needZipCode
     *
     * @param boolean $needZipCode
     * @return Country
     */
    public function setNeedZipCode($needZipCode)
    {
        $this->needZipCode = $needZipCode;
    
        return $this;
    }

    /**
     * Get needZipCode
     *
     * @return boolean 
     */
    public function getNeedZipCode()
    {
        return $this->needZipCode;
    }

    /**
     * Set zipCodeFormat
     *
     * @param string $zipCodeFormat
     * @return Country
     */
    public function setZipCodeFormat($zipCodeFormat)
    {
        $this->zipCodeFormat = $zipCodeFormat;
    
        return $this;
    }

    /**
     * Get zipCodeFormat
     *
     * @return string 
     */
    public function getZipCodeFormat()
    {
        return $this->zipCodeFormat;
    }

    /**
     * Set displayTaxLabel
     *
     * @param boolean $displayTaxLabel
     * @return Country
     */
    public function setDisplayTaxLabel($displayTaxLabel)
    {
        $this->displayTaxLabel = $displayTaxLabel;
    
        return $this;
    }

    /**
     * Get displayTaxLabel
     *
     * @return boolean 
     */
    public function getDisplayTaxLabel()
    {
        return $this->displayTaxLabel;
    }

    /**
     * Set addressFormat
     *
     * @param string $addressFormat
     * @return Country
     */
    public function setAddressFormat($addressFormat)
    {
        $this->addressFormat = $addressFormat;
    
        return $this;
    }

    /**
     * Get addressFormat
     *
     * @return string 
     */
    public function getAddressFormat()
    {
        return $this->addressFormat;
    }

    /**
     * Set timezone
     *
     * @param \KkuetNet\SharindataBundle\Entity\Timezone $timezone
     * @return Country
     */
    public function setTimezone(\KkuetNet\SharindataBundle\Entity\Timezone $timezone)
    {
        $this->timezone = $timezone;
    
        return $this;
    }

    /**
     * Get timezone
     *
     * @return \KkuetNet\SharindataBundle\Entity\Timezone 
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}