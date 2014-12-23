<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_ISSUE")
 * 
 * @author dromanin
 */
class Issue 
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $issuecode;
    
    /**
     * @ORM\ManyToOne(targetEntity="Publication")
     * @ORM\JoinColumn(name="publicationcode", referencedColumnName="publicationcode")
     */
    private $publication;
    /** @ORM\Column **/
    private $issuenumber;
    /** @ORM\Column **/
    private $title;
    /** @ORM\Column **/
    private $size;
    /** @ORM\Column **/
    private $pages;
    /** @ORM\Column **/
    private $price;
    /** @ORM\Column **/
    private $printrun;
    /** @ORM\Column **/
    private $attached;
    /** @ORM\Column **/
    private $oldestdate;
    /** @ORM\Column **/
    private $issuecomment;
    
    /**
     * @ORM\OneToMany(targetEntity="IssueUrl", mappedBy="issue")
     */
    private $urls;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="issue")
     * @ORM\OrderBy({"position"="ASC"})
     */
    private $entries;
    
    function getIssuecode() {
        return $this->issuecode;
    }

    function getPublication() {
        return $this->publication;
    }

    function getIssuenumber() {
        return $this->issuenumber;
    }

    function getTitle() {
        return $this->title;
    }

    function getSize() {
        return $this->size;
    }

    function getPages() {
        return $this->pages;
    }

    function getPrice() {
        return $this->price;
    }

    function getPrintrun() {
        return $this->printrun;
    }

    function getAttached() {
        return $this->attached;
    }

    function getOldestdate() {
        return $this->oldestdate;
    }

    function getIssuecomment() {
        return $this->issuecomment;
    }

    function getEntries() {
        return $this->entries;
    }

    public function getThumbnailUrl() 
    {
        if($this->urls && count($this->urls) > 0) {
            $first = $this->urls[0];
            return $first->generateUrl();
        }
        if($this->entries && count($this->entries) > 0) {
            $first = $this->entries[0];
            return $first->getThumbnailUrl();
        }
    }

}
