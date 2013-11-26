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
    private static $apiKey      = "dPMf3YTKM0QMunYRwqKI";
    private static $apiSecret   = "H9mibm4rLuYCQSz8AzfL";
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
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
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
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getAllColors(realpath(__DIR__."/../Resources/public/images/Sharindata.png"));
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolAllColor.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/all_countries", name="demo_data_all_countries")
     */
    public function demoDataAllCountriesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getCountries();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllCountries.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/country", name="demo_data_country")
     */
    public function demoDataCountryAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getCountry("Fr");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getCountry("Be");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataCountry.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/all_currencies", name="demo_data_all_currencies")
     */
    public function demoDataAllCurrenciesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getCurrencies();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllCurrencies.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/currency", name="demo_data_currency")
     */
    public function demoDataCurrencyAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getCurrency("USD");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getCurrency("EUR");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataCurrency.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/currency_countries", name="demo_data_currency_countries")
     */
    public function demoDataCurrencyCountriesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getCurrencyCountries("EUR");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getCurrencyCountries("USD");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataCurrencyCountries.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/all_languages", name="demo_data_all_languages")
     */
    public function demoDataAllLanguagesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getLanguages();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllLanguages.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/language", name="demo_data_language")
     */
    public function demoDataLanguageAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getLanguage("fr");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getLanguage("zh");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataLanguage.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/language_countries", name="demo_data_language_countries")
     */
    public function demoDataLanguageCountriesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getLanguageCountries("fr");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getLanguageCountries("de");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataLanguageCountries.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/all_timezones", name="demo_data_all_timezones")
     */
    public function demoDataAllTimezonesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getTimezones();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllTimezones.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/timezone", name="demo_data_timezone")
     */
    public function demoDataTimezoneAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getTimezone("europe_paris");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getTimezone("Europe_Madrid");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataTimezone.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/data/all_zones", name="demo_data_all_zones")
     */
    public function demoDataAllZonesAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getZones();
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataAllZones.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/data/zone", name="demo_data_zone")
     */
    public function demoDataZoneAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getZone("Europe");
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getZone("North_America");
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoDataZone.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
}
