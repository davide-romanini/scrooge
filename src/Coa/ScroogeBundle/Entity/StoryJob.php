<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StoryJob
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_STORYJOB")
 * 
 * @author dromanin
 */
class StoryJob
{
    /**
     * @ORM\ManyToOne(targetEntity="StoryVersion", inversedBy="jobs")
     * @ORM\JoinColumn(name="storyversioncode", referencedColumnName="storyversioncode")
     * @ORM\Id
     */
    private $storyversion;
    
    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="personcode", referencedColumnName="personcode")
     * @ORM\Id
     */
    private $person;
    
    /**
     * Describes the job: p=plot, w=writing, a=art(pencils), i=ink, r=reference, m=maintainer(incharge)
     * @ORM\Column
     * @ORM\Id
     */
    private $plotwritartink;
    
    /**
     *
     * @ORM\Column
     */
    private $storyjobcomment;
    
    public function getStoryversion() {
        return $this->storyversion;
    }

    public function getPerson() {
        return $this->person;
    }

    public function getPlotwritartink() {
        return $this->plotwritartink;
    }

    public function getStoryjobcomment() {
        return $this->storyjobcomment;
    }

    public function getRoleName() 
    {
        switch($this->plotwritartink) {
            case 'p':
                return 'plot';
            case 'w':
                return 'writer';
            case 'a':
                return 'artist';
            case 'i':
                return 'inker';
            case 'r':
                return 'reference'; // ??
            case 'm':
                return 'maintainer';
        }
    }
    
}
