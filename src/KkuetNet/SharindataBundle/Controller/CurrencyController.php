<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  

class CurrencyController extends Controller
{
    /**
     * Returns all currencies
     * @ApiDoc(section="Currency")
     * @Rest\View()
     */
    public function getCurrenciesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Currency')->findAll();
        
        $data       = array();
        foreach($entities as $e){
            $data[] = $this->getArray($e);
        }
        return $data;  
    }
    
    /**
     * Returns currency corresponding to the iso code
     * @param string $iso_code Example => eur, usd, cny
     * @ApiDoc(section="Currency")
     * @Rest\View()
     */
    public function getCurrencyAction($iso_code)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('KkuetNetSharindataBundle:Currency')->findOneBy(array(
            'isoCode' => $iso_code
        ));

        return $this->getArray($entity);  
    }
    
    private function getArray($currency){
        if($currency){
            return array(
                'id'                => $currency->getId(),
                'name'              => $currency->getName(),
                'iso_code'          => strtoupper($currency->getIsoCode()),
                'iso_code_num'      => $currency->getIsoCodeNum(),
                'sign'              => $currency->getSign(),
                'blank'             => $currency->getBlank(),
                'conversion_rate'   => $currency->getConversionRate(),
                'decimals'          => $currency->getDecimals(),
                'format'            => $currency->getCurrencyFormat()->getFormat(),
                'url'               => '/data/currencies/'.$currency->getIsoCode()
            );
        }
        else{
            return array();
        }
    }
}
