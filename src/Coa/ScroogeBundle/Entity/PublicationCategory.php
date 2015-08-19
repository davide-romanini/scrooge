<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PublicationCategory
 *
 * @ORM\Table(name="INDUCKS_PUBLICATIONCATEGORY")
 * @ORM\Entity(readOnly=true)
 * 
 */
class PublicationCategory
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Publication", inversedBy="categories")
     * @ORM\JoinColumn(name="publicationcode", referencedColumnName="publicationcode")
     */
    private $publicationcode;

    /**
     * @ORM\Column
     * @ORM\Id
     */
    private $category;

    public function getPublicationcode()
    {
        return $this->publicationcode;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
