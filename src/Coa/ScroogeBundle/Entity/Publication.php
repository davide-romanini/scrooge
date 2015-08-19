<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="INDUCKS_PUBLICATION")
 * @ORM\Entity(readOnly=true)
 * 
 */
class Publication
{
    /**
     * @var integer
     *
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $publicationcode;

    /** @ORM\Column **/
    private $countrycode;
    /** @ORM\Column **/
    private $languagecode;
    /** @ORM\Column **/
    private $title;
    /** @ORM\Column **/
    private $size;
    /** @ORM\Column **/
    private $publicationcomment;

    /**
     * @ORM\OneToMany(targetEntity="PublicationName", mappedBy="publicationcode")
     */
    private $names;

    /**
     * @ORM\OneToMany(targetEntity="PublicationCategory", mappedBy="publicationcode")
     */
    private $categories;

    function getPublicationcode() 
    {
        return $this->publicationcode;
    }

    function getCountrycode() 
    {
        return $this->countrycode;
    }

    function getLanguagecode() 
    {
        return $this->languagecode;
    }

    function getTitle() 
    {
        return $this->title;
    }

    function getSize() 
    {
        return $this->size;
    }

    function getPublicationcomment() 
    {
        return $this->publicationcomment;
    }

    function getNames()
    {
        return $this->names;
    }

    function getCategories()
    {
        return $this->categories;
    }

}
