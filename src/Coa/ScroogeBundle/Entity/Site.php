<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_SITE")
 * 
 * @author dromanin
 */
class Site 
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $sitecode;
    
    /** @ORM\Column **/
    private $urlbase;
    /** @ORM\Column **/
    private $images;
    /** @ORM\Column **/
    private $sitename;
    /** @ORM\Column **/
    private $sitelogo;
    /** @ORM\Column **/
    private $properties;
    
//    sitecode varchar(16),
//    urlbase varchar(51),
//    images CHAR(1) CHECK(images IN ('Y','N')),
//    sitename varchar(85),
//    sitelogo varchar(85),
//    properties varchar(1)
    
    public function getSitecode() {
        return $this->sitecode;
    }

    public function getUrlbase() {
        return $this->urlbase;
    }

    public function getImages() {
        return $this->images;
    }

    public function getSitename() {
        return $this->sitename;
    }

    public function getSitelogo() {
        return $this->sitelogo;
    }

    public function getProperties() {
        return $this->properties;
    }


}
