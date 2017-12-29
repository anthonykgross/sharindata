<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Country;
use AppBundle\Entity\State;
use AppBundle\Entity\Timezone;
use AppBundle\Entity\Zone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCountryData extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/../CSV/Country.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                foreach ($data as $i => $row) {
                    if ($row == "NULL") {
                        $data[$i] = null;
                    }
                }
                $country = new Country();
                $country->setIso($data[3]);
                $country->setCallPrefix($data[4]);
                $country->setContainsStates($data[5]);
                $country->setNeedIdentificationNumber($data[6]);
                $country->setNeedZipCode($data[7]);
                $country->setZipCodeFormat($data[8]);
                $country->setDisplayTaxLabel($data[9]);
                $country->setFlag($data[11]);
                $country->setName($data[12]);
                $manager->persist($country);
                $manager->flush();
            }
        }

        if (($handle = fopen(__DIR__ . "/../../XML/iso_to_timezone.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/iso_to_timezone.xml");
            foreach ($xml->children() as $e) {
                $country = $manager->getRepository(Country::class)->findOneBy(array(
                    'iso' => (string)$e['iso']
                ));
                $timezone = $manager->getRepository(Timezone::class)->findOneBy(array(
                    'name' => (string)$e['zone']
                ));
                $country->setTimezone($timezone);
                $manager->persist($country);
            }
            $manager->flush();
        }

        if (($handle = fopen(__DIR__ . "/../../XML/address_format.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/address_format.xml");
            foreach ($xml->entities->children() as $e) {
                $country = $manager->getRepository(Country::class)->findOneBy(array(
                    'iso' => (string)$e['id_country']
                ));
                if ($country) {
                    $country->setAddressFormat((string)$e->format);
                    $manager->persist($country);
                }
            }
            $manager->flush();
        }

        if (($handle = fopen(__DIR__ . "/../../XML/state.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/state.xml");
            foreach ($xml->entities->children() as $e) {
                $state = $manager->getRepository(State::class)->findOneBy(array(
                    'iso' => (string)$e['iso_code']
                ));
                $country = $manager->getRepository(Country::class)->findOneBy(array(
                    'iso' => (string)$e['id_country']
                ));

                if (!$state && $country) {
                    $state = new State();
                    $state->setName((string)$e->name);
                    $state->setCountry($country);
                    $state->setIso((string)$e['iso_code']);
                    $state->setTaxBehavior((integer)$e['tax_behavior']);
                    $manager->persist($state);
                }
            }
            $manager->flush();
        }

        if (($handle = fopen(__DIR__ . "/../../XML/country.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/country.xml");
            foreach ($xml->entities->children() as $e) {
                $zone = $manager->getRepository(Zone::class)->findOneBy(array(
                    'code' => (string)$e['id_zone']
                ));
                $country = $manager->getRepository(Country::class)->findOneBy(array(
                    'iso' => (string)$e['iso_code']
                ));
                if ($zone && $country) {
                    $country->setZone($zone);
                    $manager->persist($country);
                }
            }
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 2;
    }
}