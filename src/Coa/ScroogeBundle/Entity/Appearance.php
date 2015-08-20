<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Appearance
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_APPEARANCE")
 * 
 * @author dromanin
 */
class Appearance
{
    /**
     * @ORM\ManyToOne(targetEntity="StoryVersion", inversedBy="appearances")
     * @ORM\JoinColumn(name="storyversioncode", referencedColumnName="storyversioncode")
     * @ORM\Id
     */
    private $storyversion;

    /**
     * @ORM\ManyToOne(targetEntity="Character")
     * @ORM\JoinColumn(name="charactercode", referencedColumnName="charactercode")
     * @ORM\Id
     */
    private $character;

    /**
     *
     * @ORM\Column
     * @ORM\Id
     */
    private $number;

   /**
     *
     * @ORM\Column
     */
    private $appearancecomment;

    function getStoryversion()
    {
        return $this->storyversion;
    }

    function getCharacter()
    {
        return $this->character;
    }

    function getNumber()
    {
        return $this->number;
    }

    function getAppearancecomment()
    {
        return $this->appearancecomment;
    }


}
