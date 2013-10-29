<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadZoneData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
         if(($handle = fopen(__DIR__."/XML/zone.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/XML/zone.xml");
            foreach($xml->entities->children() as $e){
                $zone = new \KkuetNet\SharindataBundle\Entity\Zone();
                $zone->setCode((string)$e['id']);
                $zone->setName((string)$e->name);
                $manager->persist($zone);
            }
            $manager->flush();
        }
    }

    public function getOrder() {
        return 1;
    }
}
?>
