<?php

namespace AppBundle\Controller;

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
    
    /**
     * 
     * TOOLS
     * 
     */
    
    /**
     * @Route("/demo/tool/main_colors", name="demo_tool_main_colors")
     */
    public function demoToolMainColorAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getMainsColors(realpath(__DIR__ . "/../Resources/public/images/Sharindata.png"));
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getMainsColors(realpath(__DIR__ . "/../Resources/public/images/Sharindata.png"),4);
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolMainColor.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
    
    /**
     * @Route("/demo/tool/all_colors", name="demo_tool_all_colors")
     */
    public function demoToolAllColorAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getAllColors(realpath(__DIR__ . "/../Resources/public/images/Sharindata.png"));
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolAllColor.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/tool/random_string", name="demo_tool_random_string")
     */
    public function demoToolRandomStringAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getRandomString(12,3);
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolRandomString.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/tool/converter/rgbtohex", name="demo_tool_converter_rgbtohex")
     */
    public function demoToolConverterRgbtohexAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getHexByRgb(112,189,2);
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolConverterRgbtohex.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/tool/converter/hextorgb", name="demo_tool_converter_hextorgb")
     */
    public function demoToolConverterHextorgbAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getRgbByHex("#70BD02");
        $json_data1  = json_decode($data1->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolConverterHextorgb.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1));
    }
    
    /**
     * @Route("/demo/tool/user_agent", name="demo_tool_user_agent")
     */
    public function demoToolUserAgentAction(){
        $sca        = \KkuetNet\SharindataClientApi\Vendor\SharindataClientApi::getInstance(self::$apiKey, self::$apiSecret);
        $data1       = $sca->getUserAgentDetails(
                "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36",
                "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
        );
        $json_data1  = json_decode($data1->response, true);
        $data2       = $sca->getUserAgentDetails(
                "Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.10",
                "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"
        );
        $json_data2  = json_decode($data2->response, true);
        return $this->container->get('templating')->renderResponse('KkuetNetSharindataBundle:Default:demoToolUserAgent.html.twig', array('data1' => $data1->response, 'json_data1' => $json_data1, 'data2' => $data2->response, 'json_data2' => $json_data2));
    }
}
