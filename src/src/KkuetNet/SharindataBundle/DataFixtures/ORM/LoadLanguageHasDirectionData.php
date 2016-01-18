<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadLanguageHasDirectionData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {       
        if (($handle = fopen(__DIR__ . "/../CSV/LanguageHasDirection.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                foreach ($data as $i => $row) {
                    if ($row == "NULL") {
                        $data[$i] = null;
                    }
                }
                $language = $manager->getRepository("KkuetNetSharindataBundle:Language")->findOneBy(array(
                    'iso639_1' => $data[0]
                ));
                $direction = $manager->getRepository("KkuetNetSharindataBundle:Direction")->findOneBy(array(
                    'code' => $data[1]
                ));
                if($language && $direction){
                    $lhd = new \KkuetNet\SharindataBundle\Entity\LanguageHasDirection();
                    $lhd->setDirection($direction);
                    $lhd->setLanguage($language);
                    $manager->persist($lhd);
                    $manager->flush();
                }
                
            }
        }
    }

    public function getOrder() {
        return 2;
    }
}
?>
