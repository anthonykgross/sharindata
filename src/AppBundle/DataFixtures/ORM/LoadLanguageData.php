<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadLanguageData extends Fixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        if (($handle = fopen(__DIR__ . "/../../XML/language.xml", "r")) !== FALSE) {
            $xml = simplexml_load_file(__DIR__ . "/../../XML/language.xml");
            foreach ($xml->entities->children() as $e) {
                $language = new Language();
                $language->setIso6391((string)$e['iso-1']);
                $language->setIso6392((string)$e['iso-2']);
                $language->setIso6393((string)$e['iso-3']);
                $language->setNameEn((string)$e['name-en']);
                $language->setNameFr((string)$e['name-fr']);
                $language->setNaturalName((string)$e['natural-name']);
                $manager->persist($language);
            }
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}