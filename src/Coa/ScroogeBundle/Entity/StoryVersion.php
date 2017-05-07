<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StoryVersion
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_STORYVERSION")
 * 
 * @author dromanin
 */
class StoryVersion 
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $storyversioncode;
    
    /**
     * @ORM\ManyToOne(targetEntity="Story", inversedBy="versions")
     * @ORM\JoinColumn(name="storycode", referencedColumnName="storycode")
     */
    private $story;
    
    /**
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="storyversion")
     */
    private $entries;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="StoryJob", mappedBy="storyversion")
     */
    private $jobs;

    /**
     *
     * @ORM\OneToMany(targetEntity="Appearance", mappedBy="storyversion")
     */
    private $appearances;
    
    /** @ORM\Column **/
    private $entirepages;
    /** @ORM\Column **/
    private $brokenpagenumerator;
    /** @ORM\Column **/
    private $brokenpagedenominator;
    /** @ORM\Column **/
    private $brokenpageunspecified;
    
    // i=illustration c=cover, n=normal, a=article
    // n = normal, k = newspaper strip, c = cover, i = illustration, a = article, P = painting
    // f = ??
    // g = ??
    // t = ??
    // L = ??
    /** @ORM\Column **/
    private $kind;
    /** @ORM\Column **/
    private $rowsperpage;
    /** @ORM\Column **/
    private $columnsperpage;
    
// storyversioncode varchar(19),
//    storycode varchar(19),
//    entirepages int(7),
//    brokenpagenumerator int(7),
//    brokenpagedenominator int(7),
//    brokenpageunspecified CHAR(1) CHECK(brokenpageunspecified IN ('Y','N')),
//    kind varchar(1),
//    rowsperpage int(7),
//    columnsperpage int(7),
//    appisxapp CHAR(1) CHECK(appisxapp IN ('Y','N')),
//    what varchar(1),
//    appsummary text,
//    plotsummary text,
//    writsummary text,
//    artsummary text,
//    inksummary text,
//    creatorrefsummary text,
//    keywordsummary text,
//    estimatedpanels int(7)

    function getStoryversioncode() {
        return $this->storyversioncode;
    }

    function getStory() {
        return $this->story;
    }

    function getEntirepages() {
        return $this->entirepages;
    }

    function getBrokenpagenumerator() {
        return $this->brokenpagenumerator;
    }

    function getBrokenpagedenominator() {
        return $this->brokenpagedenominator;
    }

    function getBrokenpageunspecified() {
        return $this->brokenpageunspecified;
    }

    function getKind() {
        return $this->kind;
    }

    function getRowsperpage() {
        return $this->rowsperpage;
    }

    function getColumnsperpage() {
        return $this->columnsperpage;
    }
    
    public function getEntries() {
        return $this->entries;
    }

    public function getJobs() {
        return $this->jobs;
    }

    public function getAppearances()
    {
        return $this->appearances;
    }
        
    public function isCover()
    {
        return $this->kind == 'c';
    }
    
    public function isGag()
    {
        return $this->kind == 'n' && $this->entirepages <= 1 && $this->entirepages >= 0;
    }
    
    public function isArticle()
    {
        return $this->kind == 'a';
    }
    
    public function isIllustration()
    {
        //i=illustration 
        //P=painting
        return $this->kind == 'i' || $this->kind == 'P';
    }

    public function isUnknown()
    {
        return in_array($this->kind, ['f', 'g', 't', 'L']);
    }
}
