<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Direction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadDirectionData extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/../CSV/Direction.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                foreach ($data as $i => $row) {
                    if ($row == "NULL") {
                        $data[$i] = null;
                    }
                }
                $direction = new Direction();
                $direction->setCode($data[0]);
                $direction->setLabel($data[1]);
                $manager->persist($direction);
                $manager->flush();
            }
        }
    }

    public function getOrder()
    {
        return 1;
    }
}