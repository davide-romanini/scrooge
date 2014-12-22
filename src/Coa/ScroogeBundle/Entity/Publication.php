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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
