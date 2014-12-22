<?php

namespace Coa\ScroogeBundle\Controller;

use Coa\ScroogeBundle\Entity\Publication;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    
    /**
     * @Route("/series/{countrycode}/{localcode}") 
     */
    public function seriesDetailsAction($countrycode, $localcode)
    {
        $publicationcode = "$countrycode/$localcode";
        /* @var $pub Publication */
        $pub = $this->getDoctrine()->getManager()->getRepository("CoaScroogeBundle:Publication")
                ->find($publicationcode);
        if(!$pub) throw $this->createNotFoundException("The series [$publicationcode] does not exist");
        
        $s = $this->toJson([
            '@type' => ['ComicSeries', 'Periodical'],
            'name' => $pub->getTitle(),
            'comment' => $pub->getPublicationcomment(),
            'inLanguage' => $pub->getLanguagecode()
        ]);
        $r = new Response(json_encode($s));
        $r->headers->set('Content-type', 'application/ld+json');
        return $r;
    }
    
    /**
     * Merges data with schema.org context and json ld boilerplate
     * 
     * @param array $a
     */
    protected function toJson(array $a) 
    {
        $a["@context"] = "http://schema.org/";
        return $a;
    }
}
