<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationName
 *
 * @ORM\Table(name="INDUCKS_PUBLICATIONNAME")
 * @ORM\Entity(readOnly=true)
 * 
 */
class PublicationName
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="names")
     * @ORM\JoinColumn(name="publicationcode", referencedColumnName="publicationcode")
     */
    private $publicationcode;

    /**
     * @ORM\Column
     * @ORM\Id
     */
    private $publicationname;

    public function getPublicationcode()
    {
        return $this->publicationcode;
    }

    public function getPublicationname()
    {
        return $this->publicationname;
    }
}
