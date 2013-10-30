<?php
namespace KkuetNet\SharindataBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdaterCommand extends ContainerAwareCommand
{
    private $em;
    private $container;
    
    protected function configure()
    {
        $this
            ->setName('kkuetnet:sharindata:update')
            ->setDescription('Met a jour les données')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container    = $this->getContainer();
        $this->em           = $this->container->get('doctrine')->getEntityManager();
        
        $this->container->get("sharindata_updater")->purgeCache();
        $this->container->get('sharindata_updater')->importXml();
    }
}