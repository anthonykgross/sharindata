<?php

namespace KkuetNet\SharindataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CurrencyFormat
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CurrencyFormat
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
     * @ORM\Column(name="name", type="string", length=55)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=9)
     */
    private $format;

    /**
     * @ORM\OneToMany(targetEntity="Currency", mappedBy="currencyFormat", cascade={"remove", "persist"})
     */
    private $currencies;

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
     * Set id
     *
     * @param string $id
     * @return CurrencyFormat
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
    
    /**
     * Set name
     *
     * @param string $name
     * @return CurrencyFormat
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
     * Set format
     *
     * @param string $format
     * @return CurrencyFormat
     */
    public function setFormat($format)
    {
        $this->format = $format;
    
        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->currencies = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add currencies
     *
     * @param \KkuetNet\SharindataBundle\Entity\Currency $currencies
     * @return CurrencyFormat
     */
    public function addCurrencie(\KkuetNet\SharindataBundle\Entity\Currency $currencies)
    {
        $this->currencies[] = $currencies;
    
        return $this;
    }

    /**
     * Remove currencies
     *
     * @param \KkuetNet\SharindataBundle\Entity\Currency $currencies
     */
    public function removeCurrencie(\KkuetNet\SharindataBundle\Entity\Currency $currencies)
    {
        $this->currencies->removeElement($currencies);
    }

    /**
     * Get currencies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }
}