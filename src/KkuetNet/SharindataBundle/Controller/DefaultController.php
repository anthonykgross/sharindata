<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use FOS\RestBundle\View\View;  

class DefaultController extends Controller
{
    /**
     * Retourne tous les contents
     * @ApiDoc()
     */
    public function getTimezonesAction()
    {
        $em         = $this->getDoctrine()->getManager();
        $entities   = $em->getRepository('KkuetNetSharindataBundle:Country') ->findAll();
        $view = View::create()  
          ->setStatusCode(200)  
          ->setData($entities);  
  
        return $this->get('fos_rest.view_handler')->handle($view);  
    }
}
