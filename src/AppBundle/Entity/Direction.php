<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Direction
 *
 * @ORM\Table(name="Direction",uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"code"})})
 * @ORM\Entity
 * @ApiResource(
 *     collectionOperations={"get"={"method"="GET"}},
 *     itemOperations={"get"={"method"="GET"}}
 * )
 */
class Direction
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
     * @ORM\Column(name="code", type="string", length=3)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=55)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="LanguageHasDirection", mappedBy="direction", cascade={"remove", "persist"})
     */
    private $languageHasDirections;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set code
     *
     * @param string $code
     * @return Direction
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return Direction
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Add languageHasDirections
     *
     * @param LanguageHasDirection $languageHasDirections
     * @return Direction
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