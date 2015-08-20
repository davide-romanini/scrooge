<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Character
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_CHARACTER")
 * 
 * @author dromanin
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\Column
     */
    private $charactercode;

    /**
     * @ORM\Column
     */
    private $charactername;

    /**
     * @ORM\OneToMany(targetEntity="CharacterName", mappedBy="character")
     */
    private $names;

    function getCharactercode()
    {
        return $this->charactercode;
    }

    function getCharactername()
    {
        return $this->charactername;
    }

    function getNames()
    {
        return $this->names;
    }

    function getLocalizedName($lang, $preferred = true)
    {
        $preferred = $preferred ? 'Y' : 'N';
        foreach ($this->names as $n) {
            if($lang == $n->getLanguagecode() && $preferred = $n->getPreferred()) {
                return $n->getCharactername();
            }
        }
    }
}
