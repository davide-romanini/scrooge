<?php

namespace Coa\ScroogeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Entity(readOnly=true)
 * @ORM\Table(name="INDUCKS_PERSON")
 * 
 * @author dromanin
 */
class Person
{
    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $personcode;
    
    /**
     *
     * @ORM\Column
     */
    private $fullname;
    
    public function getPersoncode() {
        return $this->personcode;
    }

    public function getFullname() {
        return $this->fullname;
    }


//    personcode varchar(79),
//    nationalitycountrycode varchar(2),
//    fullname text,
//    official CHAR(1) CHECK(official IN ('Y','N')),
//    personcomment varchar(221),
//    unknownstudiomember CHAR(1) CHECK(unknownstudiomember IN ('Y','N')),
//    isfake CHAR(1) CHECK(isfake IN ('Y','N')),
//    birthname text,
//    borndate varchar(10),
//    bornplace varchar(30),
//    deceaseddate varchar(10),
//    deceasedplace varchar(31),
//    education varchar(189),
//    moviestext varchar(879),
//    comicstext varchar(1327),
//    othertext varchar(307),
//    photofilename varchar(32),
//    photocomment varchar(68),
//    photosource varchar(67),
//    personrefs varchar(180)
    
    

}
