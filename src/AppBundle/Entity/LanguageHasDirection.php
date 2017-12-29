<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LanguageHasDirection
 *
 * @ORM\Table(name="Language_has_Direction" ,uniqueConstraints={@ORM\UniqueConstraint(name="idxUnique", columns={"language_id", "direction_id"})})
 * @ORM\Entity
 */
class LanguageHasDirection
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
     * @var Direction
     *
     * @ORM\ManyToOne(targetEntity="Direction", inversedBy="languageHasDirections")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="direction_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $direction;

    /**
     * @var Language
     *
     * @ORM\ManyToOne(targetEntity="Language", inversedBy="languageHasDirections")
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
     * Set direction
     *
     * @param Direction $direction
     * @return LanguageHasDirection
     */
    public function setDirection(Direction $direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return Direction
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set language
     *
     * @param Language $language
     * @return LanguageHasDirection
     */
    public function setLanguage(Language $language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return Language
     */
    public function getLanguage()
    {
        return $this->language;
    }
}