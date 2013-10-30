<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryHasCurrency
 *
 * @ORM\Table(name="Country_has_Language" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"country_id", "language_id"})})
 * @ORM\Entity
 */
class CountryHasLanguage
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
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="countryHasLanguages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $language;
    
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
     * @return CountryHasLanguage
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
     * Set language
     *
     * @param \KkuetNet\SharindataBundle\Entity\Language $language
     * @return CountryHasLanguage
     */
    public function setLanguage(\KkuetNet\SharindataBundle\Entity\Language $language)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \KkuetNet\SharindataBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}