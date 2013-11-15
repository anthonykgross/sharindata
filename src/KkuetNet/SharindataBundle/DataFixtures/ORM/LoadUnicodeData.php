<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUnicodeData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
//         if(($handle = fopen(__DIR__."/../../XML/zone.xml", "r")) !== FALSE){
//            $xml = simplexml_load_file(__DIR__."/../../XML/zone.xml");
//            foreach($xml->entities->children() as $e){
//                $zone = new \KkuetNet\SharindataBundle\Entity\Zone();
//                $zone->setCode((string)$e['id']);
//                $zone->setName((string)$e->name);
//                $manager->persist($zone);
//            }
//            $manager->flush();
//        }

        file_put_contents(__DIR__."/../../DataFixtures/CSV/newhtml.html", "
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <body>
        <div>", FILE_APPEND);
//        for($i = 0; $i < 65536; $i++){
//            file_put_contents(__DIR__."/../../DataFixtures/CSV/newhtml.html", "$i : &#$i; U+".bin2hex(html_entity_decode("&#$i;"))."<br/>\n", FILE_APPEND);
//        }
        file_put_contents(__DIR__."/../../DataFixtures/CSV/newhtml.html", "</div>
    </body>
</html>
", FILE_APPEND);
        exit;
    }

    public function getOrder() {
        return 1;
    }
}
?>
