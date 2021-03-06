<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadCurrencyFormatData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
         if(($handle = fopen(__DIR__."/../../XML/currency_format.xml", "r")) !== FALSE){
            $xml = simplexml_load_file(__DIR__."/../../XML/currency_format.xml");
            foreach($xml->entities->children() as $e){
                $currencyFormat = new \KkuetNet\SharindataBundle\Entity\CurrencyFormat();
                $currencyFormat->setFormat((string)$e['format']);
                $currencyFormat->setName((string)$e['name']);
                $currencyFormat->setId((string)$e['id']);
                $manager->persist($currencyFormat);
            }
            $manager->flush();
        }
    }

    public function getOrder() {
        return 1;
    }
}
?>
