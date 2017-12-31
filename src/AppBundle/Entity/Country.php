<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * Country
 *
 * @ORM\Table(name="Country" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"iso"})})
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}},
 *     subresourceOperations={
 *          "country_has_currencies_get_subresource"= {
 *              "method"="GET",
 *              "path"="/countries/{id}/currencies"
 *          },
 *          "country_has_languages_get_subresource"= {
 *              "method"="GET",
 *              "path"="/countries/{id}/languages",
 *          },
 *      },
 * )
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
     * @var Zone
     *
     * @ORM\ManyToOne(targetEntity="Zone", inversedBy="countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="zone_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $zone;

    /**
     * @var Timezone
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
     * @ORM\OneToMany(targetEntity="CountryHasCurrency", mappedBy="country", cascade={"remove", "persist"})
     * @ApiSubresource()
     */
    private $countryHasCurrencies;

    /**
     * @ORM\OneToMany(targetEntity="CountryHasLanguage", mappedBy="country", cascade={"remove", "persist"})
     * @ApiSubresource()
     */
    private $countryHasLanguages;

    /**
     * @ORM\OneToMany(targetEntity="Tax", mappedBy="country", cascade={"remove", "persist"})
     * @ApiSubresource()
     */
    private $taxes;

    /**
     * @ORM\OneToMany(targetEntity="State", mappedBy="country", cascade={"remove", "persist"})
     * @ApiSubresource()
     */
    private $states;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=12, nullable=true)
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=55, nullable=true)
     */
    private $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countryHasCurrencies = new ArrayCollection();
        $this->countryHasLanguages = new ArrayCollection();
        $this->taxes = new ArrayCollection();
        $this->states = new ArrayCollection();
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
     * Set zone
     *
     * @param Zone $zone
     * @return Country
     */
    public function setZone(Zone $zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set timezone
     *
     * @param Timezone $timezone
     * @return Country
     */
    public function setTimezone(Timezone $timezone = null)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return Timezone
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Add countryHasCurrencies
     *
     * @param CountryHasCurrency $countryHasCurrencies
     * @return Country
     */
    public function addCountryHasCurrencie(CountryHasCurrency $countryHasCurrencies)
    {
        $this->countryHasCurrencies[] = $countryHasCurrencies;

        return $this;
    }

    /**
     * Remove countryHasCurrencies
     *
     * @param CountryHasCurrency $countryHasCurrencies
     */
    public function removeCountryHasCurrencie(CountryHasCurrency $countryHasCurrencies)
    {
        $this->countryHasCurrencies->removeElement($countryHasCurrencies);
    }

    /**
     * Get countryHasCurrencies
     *
     * @return ArrayCollection
     */
    public function getCountryHasCurrencies()
    {
        return $this->countryHasCurrencies;
    }

    /**
     * Add countryHasLanguages
     *
     * @param CountryHasLanguage $countryHasLanguages
     * @return Country
     */
    public function addCountryHasLanguage(CountryHasLanguage $countryHasLanguages)
    {
        $this->countryHasLanguages[] = $countryHasLanguages;

        return $this;
    }

    /**
     * Remove countryHasLanguages
     *
     * @param CountryHasLanguage $countryHasLanguages
     */
    public function removeCountryHasLanguage(CountryHasLanguage $countryHasLanguages)
    {
        $this->countryHasLanguages->removeElement($countryHasLanguages);
    }

    /**
     * Get countryHasLanguages
     *
     * @return ArrayCollection
     */
    public function getCountryHasLanguages()
    {
        return $this->countryHasLanguages;
    }

    /**
     * Add taxes
     *
     * @param \AppBundle\Entity\Tax $taxes
     * @return Country
     */
    public function addTaxe(\AppBundle\Entity\Tax $taxes)
    {
        $this->taxes[] = $taxes;

        return $this;
    }

    /**
     * Remove taxes
     *
     * @param \AppBundle\Entity\Tax $taxes
     */
    public function removeTaxe(\AppBundle\Entity\Tax $taxes)
    {
        $this->taxes->removeElement($taxes);
    }

    /**
     * Get taxes
     *
     * @return ArrayCollection
     */
    public function getTaxes()
    {
        return $this->taxes;
    }

    /**
     * Add states
     *
     * @param \AppBundle\Entity\State $states
     * @return Country
     */
    public function addState(\AppBundle\Entity\State $states)
    {
        $this->states[] = $states;

        return $this;
    }

    /**
     * Remove states
     *
     * @param \AppBundle\Entity\State $states
     */
    public function removeState(\AppBundle\Entity\State $states)
    {
        $this->states->removeElement($states);
    }

    /**
     * Get states
     *
     * @return ArrayCollection
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Country
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
}