<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Zone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadZoneData extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/../../XML/zone.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/zone.xml");
            foreach ($xml->entities->children() as $e) {
                $zone = new Zone();
                $zone->setCode((string)$e['id']);
                $zone->setName((string)$e->name);
                $manager->persist($zone);
            }
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}