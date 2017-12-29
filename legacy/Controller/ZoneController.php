<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  

class ZoneController extends Controller
{
    /**
     * Returns all zones
     * @ApiDoc(section="Zone")
     * @Rest\View()
     */
    public function getZonesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Zone')->findAll();
        
        $data       = array();
        foreach($entities as $e){
            $data[] = $this->getArray($e);
        }
        return $data;  
    }
    
    /**
     * Returns zone corresponding to the code
     * @param string $code Example => europe, oceania
     * @ApiDoc(section="Zone")
     * @Rest\View()
     */
    public function getZoneAction($code)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('KkuetNetSharindataBundle:Zone')->findOneBy(array(
            'code' => $code
        ));

        return $this->getArray($entity);  
    }
    
    private function getArray($zone){
        $data = array();
        if($zone){
            $data = array(
                'id'                => $zone->getId(),
                'name'              => $zone->getName(),
                'code'              => strtoupper($zone->getCode()),
            );

            $data['countries'] = array();
            foreach($zone->getCountries() as $c){
                $data['countries'][] = array(
                    'iso'       => strtoupper($c->getIso()),
                    'url'       => '/data/country/'.$c->getIso()
                );
            }

            $data['url']            = '/data/zone/'.$zone->getCode();
        }
        return $data;
    }
}
