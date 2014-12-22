<?php

namespace Coa\ScroogeBundle\Controller;

use Doctrine\Common\Util\Debug;
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
        $pub = $this->getDoctrine()->getManager()->getRepository("CoaScroogeBundle:Publication")
                ->find($publicationcode);
        if(!$pub) throw $this->createNotFoundException("The series [$publicationcode] does not exist");
        Debug::dump($pub);
        return new Response();
    }
}
