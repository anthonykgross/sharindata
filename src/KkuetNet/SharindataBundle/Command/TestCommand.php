<?php
namespace KkuetNet\SharindataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    private $em;
    private $container;
    
    protected function configure()
    {
        $this
            ->setName('kkuetnet:sharindata:test')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container    = $this->getContainer();
        $this->em           = $this->container->get('doctrine')->getEntityManager();

        $test = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance("dPMf3YTKM0QMunYRwqKI", "H9mibm4rLuYCQSz8AzfL");
        
        var_dump($test->getUserAgentDetails(
                "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36",
                "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
        ));
    }
}