<?php

namespace AppBundle\Entity;

use AppBundle\Entity\CountryHasLanguage;
use AppBundle\Entity\LanguageHasDirection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Language
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
 * )
 */
class Language
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
     * @ORM\Column(name="iso_639_1", type="string", length=3)
     */
    private $iso639_1;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_639_2", type="string", length=7)
     */
    private $iso639_2;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_639_3", type="string", length=10)
     */
    private $iso639_3;

    /**
     * @var string
     *
     * @ORM\Column(name="name_fr", type="string", length=32)
     */
    private $nameFr;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", length=32)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="natural_name", type="string", length=55)
     */
    private $naturalName;

    /**
     * @ORM\OneToMany(targetEntity="CountryHasLanguage", mappedBy="language", cascade={"remove", "persist"})
     */
    private $countryHasLanguages;

    /**
     * @ORM\OneToMany(targetEntity="LanguageHasDirection", mappedBy="language", cascade={"remove", "persist"})
     */
    private $languageHasDirections;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->countryHasLanguages = new ArrayCollection();
        $this->languageHasDirections = new ArrayCollection();
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
     * Set iso639_1
     *
     * @param string $iso6391
     * @return Language
     */
    public function setIso6391($iso6391)
    {
        $this->iso639_1 = $iso6391;

        return $this;
    }

    /**
     * Get iso639_1
     *
     * @return string
     */
    public function getIso6391()
    {
        return $this->iso639_1;
    }

    /**
     * Set iso639_2
     *
     * @param string $iso6392
     * @return Language
     */
    public function setIso6392($iso6392)
    {
        $this->iso639_2 = $iso6392;

        return $this;
    }

    /**
     * Get iso639_2
     *
     * @return string
     */
    public function getIso6392()
    {
        return $this->iso639_2;
    }

    /**
     * Set iso639_3
     *
     * @param string $iso6393
     * @return Language
     */
    public function setIso6393($iso6393)
    {
        $this->iso639_3 = $iso6393;

        return $this;
    }

    /**
     * Get iso639_3
     *
     * @return string
     */
    public function getIso6393()
    {
        return $this->iso639_3;
    }

    /**
     * Set nameFr
     *
     * @param string $nameFr
     * @return Language
     */
    public function setNameFr($nameFr)
    {
        $this->nameFr = $nameFr;

        return $this;
    }

    /**
     * Get nameFr
     *
     * @return string
     */
    public function getNameFr()
    {
        return $this->nameFr;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     * @return Language
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set naturalName
     *
     * @param string $naturalName
     * @return Language
     */
    public function setNaturalName($naturalName)
    {
        $this->naturalName = $naturalName;

        return $this;
    }

    /**
     * Get naturalName
     *
     * @return string
     */
    public function getNaturalName()
    {
        return $this->naturalName;
    }

    /**
     * Add countryHasLanguages
     *
     * @param CountryHasLanguage $countryHasLanguages
     * @return Language
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
     * Add languageHasDirections
     *
     * @param LanguageHasDirection $languageHasDirections
     * @return Language
     */
    public function addLanguageHasDirection(LanguageHasDirection $languageHasDirections)
    {
        $this->languageHasDirections[] = $languageHasDirections;

        return $this;
    }

    /**
     * Remove languageHasDirections
     *
     * @param LanguageHasDirection $languageHasDirections
     */
    public function removeLanguageHasDirection(LanguageHasDirection $languageHasDirections)
    {
        $this->languageHasDirections->removeElement($languageHasDirections);
    }

    /**
     * Get languageHasDirections
     *
     * @return ArrayCollection
     */
    public function getLanguageHasDirections()
    {
        return $this->languageHasDirections;
    }
}