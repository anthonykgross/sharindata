<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  

class TimezoneController extends Controller
{
    /**
     * Returns all timezones
     * @ApiDoc(section="Timezone")
     * @Rest\View()
     */
    public function getTimezonesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Timezone')->findAll();
        
        $data       = array();
        foreach($entities as $e){
            $data[] = $this->getArray($e);
        }
        return $data;  
    }
    
    /**
     * Returns timezone corresponding to the code
     * @param string $code Example => europe_paris
     * @ApiDoc(section="Timezone")
     * @Rest\View()
     */
    public function getTimezoneAction($code)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('KkuetNetSharindataBundle:Timezone')->findOneBy(array(
            'code' => $code
        ));

        return $this->getArray($entity);  
    }
    
    private function getArray($timezone){
        $data = array();
        if($timezone){
            
            $tz         = new \DateTimeZone($timezone->getName());
            $date       = new \DateTime("now", $tz);
            $location   = $tz->getLocation();
            
            $data = array(
                'id'                => $timezone->getId(),
                'name'              => $timezone->getName(),
                'code'              => $timezone->getCode(),
                'date'               => $date->format("r"),
                'location'          => $location
            );

            $data['countries'] = array();
            foreach($timezone->getCountries() as $c){
                $data['countries'][] = array(
                    'iso'       => $c->getIso(),
                    'url'       => '/data/countries/'.$c->getIso()
                );
            }

            $data['url']            = '/data/timezones/'.$timezone->getCode();
        }
        return $data;
    }
}
