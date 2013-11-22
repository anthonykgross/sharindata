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
    
    /**
     * @Route("/demo", name="demo_index")
     */
    public function demoIndexAction(){
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoIndex.html.twig', array());
    }
    
    /**
     * @Route("/demo/tool/main_colors", name="demo_tool_main_colors")
     */
    public function demoToolMainColorAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance("kkuet12@live.fr", "050688");
        $data1       = $sca->getMainsColors(realpath(__DIR__."/../Resources/public/images/Sharindata.png"));
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getMainsColors(realpath(__DIR__."/../Resources/public/images/Sharindata.png"),4);
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolMainColor.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/tool/all_colors", name="demo_tool_all_colors")
     */
    public function demoToolAllColorAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance("kkuet12@live.fr", "050688");
        $data1       = $sca->getAllColors(realpath(__DIR__."/../Resources/public/images/Sharindata.png"));
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolAllColor.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/all_countries", name="demo_data_all_countries")
     */
    public function demoDataAllCountriesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance("kkuet12@live.fr", "050688");
        $data1       = $sca->getCountries();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllCountries.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/country", name="demo_data_country")
     */
    public function demoDataCountryAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance("kkuet12@live.fr", "050688");
        $data1       = $sca->getCountry("Fr");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getCountry("Be");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataCountry.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
}
