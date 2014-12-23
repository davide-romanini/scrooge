<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntryUrl
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_EntryURL")
 * 
 * @author dromanin
 */
class EntryUrl
{
    /**
     * @ORM\ManyToOne(targetEntity="Entry", inversedBy="urls")
     * @ORM\JoinColumn(name="entrycode", referencedColumnName="entrycode")
     * @ORM\Id
     */
    private $entry;
    
    /**
     * @ORM\ManyToOne(targetEntity="Site")
     * @ORM\JoinColumn(name="sitecode", referencedColumnName="sitecode")
     * @ORM\Id
     */
    private $site;
    
    /**
     * @ORM\Column
     * @ORM\Id
     */
    private $url;
    
    /**
     * @ORM\Column
     * @ORM\Id
     */
    private $pagenumber;
    
    public function generateUrl() 
    {
        return $this->site->getUrlbase() . $this->url;
    }

}
