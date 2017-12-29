<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Timezone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadTimezoneData extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/../../XML/timezone.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/timezone.xml");
            foreach ($xml->entities->children() as $e) {
                $timezone = new Timezone();
                $timezone->setCode((string)$e['id']);
                $timezone->setName((string)$e['name']);
                $manager->persist($timezone);
            }
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}