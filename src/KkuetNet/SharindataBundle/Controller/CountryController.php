<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  

class CountryController extends Controller
{
    /**
     * Returns all countries
     * @ApiDoc(section="Country")
     * @Rest\View()
     */
    public function getCountriesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Country')->findAll();
        
        $data       = array();
        foreach($entities as $e){
            $data[] = $this->getArray($e);
        }
        return $data;  
    }
    
    /**
     * Returns country corresponding to the iso
     * @param string $iso Example => fr, us, de
     * @ApiDoc(section="Country")
     * @Rest\View()
     */
    public function getCountryAction($iso)
    {
        $em         = $this->getDoctrine()->getManager();
        $entity     = $em->getRepository('KkuetNetSharindataBundle:Country')->findOneBy(array(
            'iso' => $iso
        ));

        return $this->getArray($entity);  
    }
    
    private function getArray($country){
        $data = array();
        
        if($country){
            $data = array(
                'id'                        => $country->getId(),
                'iso'                       => $country->getIso(),
                'call_prefix'               => $country->getCallPrefix(),
                'contains_states'           => $country->getContainsStates(),
                'need_identification_number'=> $country->getNeedIdentificationNumber(),
                'need_zip_code'             => $country->getNeedZipCode(),
                'zip_code_format'           => $country->getZipCodeFormat(),
                'display_tax_label'         => $country->getDisplayTaxLabel(),
                'address_format'            => $country->getAddressFormat(),
                'flag'                      => "http://sharindata.com/bundles/kkuetnetsharindata/images/flags/64/".$country->getFlag().".png",
                'name'                      => $country->getName(),
                'zone'                      => array(
                    'code' => $country->getZone()->getCode(),
                    'name' => $country->getZone()->getName(),
                    'url'      => '/data/zones/'.$country->getZone()->getCode()
                ),
            );
            
            $data['states'] = array();
            foreach($country->getStates() as $s){
                $data['states'][] = array(
                    'name' => $s->getName(),
                    'iso' => $s->getIso(),
                    'tax_behavior' => $s->getTaxBehavior()
                );
            }
            
            if($country->getTimezone()){
                $data['timezone'] = array(
                    'code' => $country->getTimezone()->getCode(),
                    'name' => $country->getTimezone()->getName(),
                    'url'      => '/data/timezones/'.$country->getTimezone()->getCode()
                );
            }

            $data['currencies'] = array();
            foreach($country->getCountryHasCurrencies() as $chc){
                $data['currencies'][] = array(
                    'iso_code' => $chc->getCurrency()->getIsoCode(),
                    'url'      => '/data/currencies/'.$chc->getCurrency()->getIsoCode()
                );
            }

            $data['languages'] = array();
            foreach($country->getCountryHasLanguages() as $chl){
                $data['languages'][] = array(
                    'iso639-1' => $chl->getLanguage()->getIso6391(),
                    'url'      => '/data/languages/'.$chl->getLanguage()->getIso6391()
                );
            }

            $data['taxes'] = array();
            foreach($country->getTaxes() as $t){
                $data['taxes'][] = array(
                    'name' => $t->getName(),
                    'rate' => $t->getRate()
                );
            }
        }
        return $data;
    }
}
