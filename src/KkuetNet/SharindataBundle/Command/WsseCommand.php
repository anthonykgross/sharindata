<?php
namespace KkuetNet\SharindataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WsseCommand extends ContainerAwareCommand
{
    private $em;
    private $container;
    
    protected function configure()
    {
        $this
            ->setName('kkuetnet:sharindata:wsse')
            ->setDescription('Met a jour les données')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container    = $this->getContainer();
        $this->em           = $this->container->get('doctrine')->getEntityManager();
        
        $test = new \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi("kkuet12@live.fr", "050688");
        var_dump($test->getCountry("fr"));
        var_dump($test->getCountry("us"));
        var_dump($test->getCountry("be"));
        var_dump($test->getCountries());
    }
}