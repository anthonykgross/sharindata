<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="_welcome")
     */
    public function indexAction(){
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:index.html.twig', array());
    }
}
