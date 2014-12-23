<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IssueUrl
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_ISSUEURL")
 * 
 * @author dromanin
 */
class IssueUrl
{
    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="urls")
     * @ORM\JoinColumn(name="issuecode", referencedColumnName="issuecode")
     * @ORM\Id
     */
    private $issue;
    
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
    
    public function generateUrl() 
    {
        return $this->site->getUrlbase() . $this->url;
    }
//    issuecode varchar(14),
//    sitecode varchar(12),
//    url varchar(12)
}
