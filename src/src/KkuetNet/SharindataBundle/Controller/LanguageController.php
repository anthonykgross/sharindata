<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  

class LanguageController extends Controller
{
    /**
     * Returns all languages
     * @ApiDoc(section="Language")
     * @Rest\View()
     */
    public function getLanguagesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Language')->findAll();
        
        $data       = array();
        foreach($entities as $e){
            $data[] = $this->getArray($e);
        }
        return $data;  
    }
    
    /**
     * Returns language corresponding to the iso code 639-1
     * @param string $iso_code_6391 Example => fr, de, ar
     * @ApiDoc(section="Language")
     * @Rest\View()
     */
    public function getLanguageAction($iso_code_6391)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('KkuetNetSharindataBundle:Language')->findOneBy(array(
            'iso639_1' => $iso_code_6391
        ));

        return $this->getArray($entity);  
    }
        
    private function getArray($language){
        $data = array();
        
        if($language){
            $data = array(
                'id'                    => $language->getId(),
                'iso_639_1'             => strtoupper($language->getIso6391()),
                'iso_639_2'             => strtoupper($language->getIso6392()),
                'iso_639_3'             => strtoupper($language->getIso6393()),
                'name_fr'               => $language->getNameFr(),
                'name_en'               => $language->getNameEn(),
                'natural_name'          => $language->getNaturalName(),
                'url'                   => '/data/language/'.$language->getIso6391()
            );
            
            $data['directions'] = array();
            foreach($language->getLanguageHasDirections() as $s){
                $data['directions'][] = array(
                    'name' => $s->getDirection()->getLabel(),
                    'code' => $s->getDirection()->getCode()
                );
            }
        }
        
        return $data;
    }
}
