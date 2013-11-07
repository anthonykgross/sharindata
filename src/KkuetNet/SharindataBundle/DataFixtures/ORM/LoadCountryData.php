<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCountryData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
         if(($handle = fopen(__DIR__."/../../XML/country.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/../../XML/country.xml");
            foreach($xml->entities->children() as $e){
                $zone = $manager->getRepository("KkuetNetSharindataBundle:Zone")->findOneBy(array(
                    'code' => (string)$e['id_zone']
                ));
                $country = new \KkuetNet\SharindataBundle\Entity\Country();
                $country->setIso((string)$e['iso_code']);
                $country->setZone($zone);
                $country->setCallPrefix((string)$e['call_prefix']);
                $country->setContainsStates((int)$e['contains_states']);
                $country->setNeedIdentificationNumber((int)$e['need_identification_number']);
                $country->setNeedZipCode((int)$e['need_zip_code']);
                $country->setZipCodeFormat((string)$e['zip_code_format']);
                $country->setDisplayTaxLabel((int)$e['display_tax_label']);
                $manager->persist($country);
            }
            $manager->flush();
        }
        
        if(($handle = fopen(__DIR__."/../../XML/iso_to_timezone.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/../../XML/iso_to_timezone.xml");
            foreach($xml->children() as $e){
                $country = $manager->getRepository("KkuetNetSharindataBundle:Country")->findOneBy(array(
                    'iso' => (string)$e['iso']
                ));
                $timezone = $manager->getRepository("KkuetNetSharindataBundle:Timezone")->findOneBy(array(
                    'name' => (string)$e['zone']
                ));
                $country->setTimezone($timezone);
                $manager->persist($country);
            }
            $manager->flush();
        }
        
        if(($handle = fopen(__DIR__."/../../XML/address_format.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/../../XML/address_format.xml");
            foreach($xml->entities->children() as $e){
                $country = $manager->getRepository("KkuetNetSharindataBundle:Country")->findOneBy(array(
                    'iso' => (string)$e['id_country']
                ));
                if($country){
                    $country->setAddressFormat((string)$e->format);
                    $manager->persist($country);
                }
            }
            $manager->flush();
        }
        
        if(($handle = fopen(__DIR__."/../../XML/state.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/../../XML/state.xml");
            foreach($xml->entities->children() as $e){
                $state = $manager->getRepository("KkuetNetSharindataBundle:State")->findOneBy(array(
                    'iso' => (string)$e['iso_code']
                ));
                $country = $manager->getRepository("KkuetNetSharindataBundle:Country")->findOneBy(array(
                    'iso' => (string)$e['id_country']
                ));
                
                if(!$state && $country){
                    $state = new \KkuetNet\SharindataBundle\Entity\State();
                    $state->setName((string)$e->name);
                    $state->setCountry($country);
                    $state->setIso((string)$e['iso_code']);
                    $state->setTaxBehavior((integer)$e['tax_behavior']);
                    $manager->persist($state);
                }
            }
            $manager->flush();
        }
    }

    public function getOrder() {
        return 2;
    }
}
?>
