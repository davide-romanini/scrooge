<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntryJob
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_ENTRYJOB")
 * 
 * @author dromanin
 */
class EntryJob
{
    /**
     * @ORM\ManyToOne(targetEntity="Entry", inversedBy="jobs")
     * @ORM\JoinColumn(name="entrycode", referencedColumnName="entrycode")
     * @ORM\Id
     */
    private $entry;
    
    /**
     * @ORM\ManyToOne(targetEntity="Person")
     * @ORM\JoinColumn(name="personcode", referencedColumnName="personcode")
     * @ORM\Id
     */
    private $person;
    
    /**
     * Describes the job: t=translation, l=lettering, c=colouring
     * @ORM\Column
     * @ORM\Id
     */
    private $transletcol;
    
    /**
     *
     * @ORM\Column
     */
    private $entryjobcomment;
    
    public function getEntry() {
        return $this->entry;
    }

    public function getPerson() {
        return $this->person;
    }

    public function getTransletcol() {
        return $this->transletcol;
    }

    public function getEntryjobcomment() {
        return $this->entryjobcomment;
    }

    public function getRoleName()
    {
        switch($this->transletcol) {
            case 'l':
                return 'letterer';
            case 't':
                return 'translator';
            case 'c':
                return 'colorist';
        }
    }

}
