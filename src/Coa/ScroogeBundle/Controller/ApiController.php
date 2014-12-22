<?php

namespace Coa\ScroogeBundle\Controller;

use Coa\ScroogeBundle\Entity\Issue;
use Coa\ScroogeBundle\Entity\Publication;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ApiController extends Controller
{
    
    /**
     * @Route("/series/{countrycode}/{localcode}", name="series_detail") 
     */
    public function seriesDetailAction($countrycode, $localcode)
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
     * @Route("/series/{countrycode}/{localcode}/issues/{issuenumber}") 
     */
    public function issueDetailsAction($countrycode, $localcode, $issuenumber)
    {
        $publicationcode = "$countrycode/$localcode";
        
        /* @var $is Issue */
        $is = $this->getDoctrine()->getManager()->getRepository("CoaScroogeBundle:Issue")
                ->findBy([
                    'publication' => $publicationcode,
                    'issuenumber' => $issuenumber
        ]);
        if(empty($is)) throw $this->createNotFoundException ("The issue [$publicationcode] number #$issuenumber does not exist");
        $is = $is[0];
        
        $i = $this->toJson([
            '@type' => ['ComicIssue', 'PublicationIssue'],
            'name' => $is->getTitle(),
            'isPartOf' => $this->generateUrl('series_detail', [
                'countrycode' => $countrycode, 
                'localcode' => $localcode
            ], UrlGeneratorInterface::ABSOLUTE_URL),
            'comment' => $is->getIssuecomment(),
            'pageEnd' => $is->getPages(),
        ]);
        $r = new Response(json_encode($i));
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
