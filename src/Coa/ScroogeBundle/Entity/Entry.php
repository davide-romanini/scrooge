<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_ENTRY")
 * 
 * @author dromanin
 */
class Entry 
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $entrycode;
    
    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="entries")
     * @ORM\JoinColumn(name="issuecode", referencedColumnName="issuecode")
     */
    private $issue;
    
    /**
     * @ORM\ManyToOne(targetEntity="StoryVersion")
     * @ORM\JoinColumn(name="storyversioncode", referencedColumnName="storyversioncode")
     */
    private $storyversion;
    
    /**
     * @ORM\OneToMany(targetEntity="EntryUrl", mappedBy="entry")
     * @ORM\OrderBy({"pagenumber"="ASC"})
     */
    private $urls;
    
    /**
     * @ORM\OneToMany(targetEntity="EntryJob", mappedBy="entry")
     */
    private $jobs;
    
    /** @ORM\Column **/
    private $languagecode;
    /** @ORM\Column **/
    private $includedinentrycode;
    /** @ORM\Column **/
    private $position;
    /** @ORM\Column **/
    private $printedcode;
    /** @ORM\Column **/
    private $guessedcode;
    /** @ORM\Column **/
    private $title;
    /** @ORM\Column **/
    private $reallytitle;
    /** @ORM\Column **/
    private $printedhero;
    /** @ORM\Column **/
    private $changes;
    /** @ORM\Column **/
    private $cut;
    /** @ORM\Column **/
    private $minorchanges;
    /** @ORM\Column **/
    private $missingpanels;
    /** @ORM\Column **/
    private $mirrored;
    /** @ORM\Column **/
    private $sideways;
    /** @ORM\Column **/
    private $startdate;
    /** @ORM\Column **/
    private $enddate;
    /** @ORM\Column **/
    private $part;
    /** @ORM\Column **/
    private $entrycomment;
    
    function getEntrycode() {
        return $this->entrycode;
    }

    function getIssue() {
        return $this->issue;
    }

    function getStoryversion() {
        return $this->storyversion;
    }

    function getLanguagecode() {
        return $this->languagecode;
    }

    function getIncludedinentrycode() {
        return $this->includedinentrycode;
    }

    function getPosition() {
        return $this->position;
    }

    function getPrintedcode() {
        return $this->printedcode;
    }

    function getGuessedcode() {
        return $this->guessedcode;
    }

    function getTitle() {
        return $this->title;
    }

    function getReallytitle() {
        return $this->reallytitle;
    }

    function getPrintedhero() {
        return $this->printedhero;
    }

    function getChanges() {
        return $this->changes;
    }

    function getCut() {
        return $this->cut;
    }

    function getMinorchanges() {
        return $this->minorchanges;
    }

    function getMissingpanels() {
        return $this->missingpanels;
    }

    function getMirrored() {
        return $this->mirrored;
    }

    function getSideways() {
        return $this->sideways;
    }

    function getStartdate() {
        return $this->startdate;
    }

    function getEnddate() {
        return $this->enddate;
    }

    function getPart() {
        return $this->part;
    }

    function getEntrycomment() {
        return $this->entrycomment;
    }
    
    public function getUrls() {
        return $this->urls;
    }

    public function getJobs() {
        return $this->jobs;
    }

        
    
    public function getThumbnailUrl() 
    {
        if($this->urls && count($this->urls) > 0) {
            $first = $this->urls[0];
            return $first->generateUrl();
        }
    }
    
//         entrycode varchar(22),
//    issuecode varchar(17),
//    storyversioncode varchar(19),
//    languagecode varchar(7),
//    includedinentrycode varchar(18),
//    position varchar(10),
//    printedcode varchar(88),
//    guessedcode varchar(39),
//    title varchar(235),
//    reallytitle CHAR(1) CHECK(reallytitle IN ('Y','N')),
//    printedhero varchar(96),
//    changes varchar(596),
//    cut varchar(100),
//    minorchanges varchar(558),
//    missingpanels varchar(2),
//    mirrored CHAR(1) CHECK(mirrored IN ('Y','N')),
//    sideways CHAR(1) CHECK(sideways IN ('Y','N')),
//    startdate varchar(10),
//    enddate varchar(10),
//    identificationuncertain CHAR(1) CHECK(identificationuncertain IN ('Y','N')),
//    alsoreprint varchar(66),
//    part varchar(5),
//    entrycomment varchar(3476),
//    error CHAR(1) CHECK(error IN ('Y','N'))

}
