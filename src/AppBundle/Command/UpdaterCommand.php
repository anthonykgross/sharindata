<?php

namespace AppBundle\Command;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdaterCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ContainerInterface
     */
    private $container;

    protected function configure()
    {
        $this
            ->setName('sharindata:update')
            ->setDescription('Update database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getContainer();
        $this->em = $this->container->get('doctrine')->getManager();

        $this->container->get("sharindata.updater")->purgeCache();
        $this->container->get('sharindata.updater')->importXml();
    }
}