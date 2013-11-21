<?php
namespace KkuetNet\SharindataBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadUnicodeData implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager) {
    }

    public function getOrder() {
        return 1;
    }
}
?>
