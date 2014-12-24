<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_STORY")
 * 
 * @author dromanin
 */
class Story
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $storycode;
    
    /**
     * @ORM\ManyToOne(targetEntity="StoryVersion")
     * @ORM\JoinColumn(name="originalstoryversioncode", referencedColumnName="storyversioncode")
     */
    private $originalstoryversion;
    /** @ORM\Column **/
    private $creationdate;
    /** @ORM\Column **/
    private $firstpublicationdate;
    /** @ORM\Column **/
    private $endpublicationdate;
    /** @ORM\Column **/
    private $title;
    /** @ORM\Column **/
    private $storycomment;
    /** @ORM\Column **/
    private $storyparts;
    
    /**
     * @ORM\ManyToOne(targetEntity="Issue")
     * @ORM\JoinColumn(name="issuecodeofstoryitem", referencedColumnName="issuecode")
     */
    private $issueofstoryitem;
    
    /**
     * @ORM\OneToMany(targetEntity="StoryVersion", mappedBy="story")
     */
    private $versions;
    
//    originalstoryversioncode varchar(19),
//    creationdate varchar(21),
//    firstpublicationdate varchar(10),
//    endpublicationdate varchar(10),
//    title text,
//    usedifferentcode varchar(19),
//    storycomment varchar(664),
//    error CHAR(1) CHECK(error IN ('Y','N')),
//    repcountrysummary text,
//    storyparts int(7),
//    locked CHAR(1) cHECK(locked IN ('Y','N')),
//    inputfilecode int(7),
//    issuecodeofstoryitem varchar(14)
    
    function getStorycode() {
        return $this->storycode;
    }

    function getOriginalstoryversion() {
        return $this->originalstoryversion;
    }

    function getCreationdate() {
        return $this->creationdate;
    }

    function getFirstpublicationdate() {
        return $this->firstpublicationdate;
    }

    function getEndpublicationdate() {
        return $this->endpublicationdate;
    }

    function getTitle() {
        return $this->title;
    }

    function getStorycomment() {
        return $this->storycomment;
    }

    function getStoryparts() {
        return $this->storyparts;
    }

    function getIssueofstoryitem() {
        return $this->issueofstoryitem;
    }

    public function getVersions() {
        return $this->versions;
    }

}
