<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CharacterName
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_CHARACTERNAME")
 * 
 * @author dromanin
 */
class CharacterName
{
    /**
     * @ORM\ManyToOne(targetEntity="Character", inversedBy="names")
     * @ORM\JoinColumn(name="charactercode", referencedColumnName="charactercode")
     * @ORM\Id
     */
    private $character;

    /**
     * @ORM\Column
     * @ORM\Id
     */
    private $languagecode;

    /**
     * @ORM\Column
     */
    private $charactername;

    /**
     * @ORM\Column
     */
    private $preferred;

    /**
     * @ORM\Column
     */
    private $characternamecomment;

    function getCharacter()
    {
        return $this->character;
    }

    function getLanguagecode()
    {
        return $this->languagecode;
    }

    function getCharactername()
    {
        return $this->charactername;
    }

    function getPreferred()
    {
        return $this->preferred;
    }

    function getCharacternamecomment()
    {
        return $this->characternamecomment;
    }


}
