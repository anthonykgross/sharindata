<?php
namespace KkuetNet\SharindataBundle\Services;

class Updater {

    private $container  = null;
    private $em         = null;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getEntityManager();
    }
    
    /**
     * Met à jour les fichiers XML
     */
    public function purgeCache(){
        $countries = $this->em->getRepository("KkuetNetSharindataBundle:Country")->findAll();
        foreach($countries as $c){
            $content = @file_get_contents("http://api.prestashop.com/localization/15/".strtolower($c->getIso()).".xml");

            if($content){
                echo strtolower($c->getIso()).".xml : Ok\n";
                file_put_contents(__DIR__."/../XML/cache/api/".strtolower($c->getIso()).".xml", $content);
            }
            else{
                echo strtolower($c->getIso()).".xml : Fail\n";
            }
        }
    }
    
    /**
     * Charge les fichiers XML dans XML/cache/api/ en BDD
     */
    public function importXml(){
        $this->em->getConnection()->beginTransaction();
        $this->clearApiData();
        
        if ($handle = opendir(__DIR__."/../XML/cache/api/")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != ".svn") {
                    $xml = simplexml_load_file(__DIR__."/../XML/cache/api/".$entry);
                    
                    $country = $this->em->getRepository("KkuetNetSharindataBundle:Country")->findOneBy(array(
                        "iso" => str_replace(".xml", "", $entry)
                    ));
                    
                    if($country){
                        //Chargement des devises connus du pays
                        if($xml->currencies){
                            foreach($xml->currencies->children() as $e){
                                $currency = $this->em->getRepository("KkuetNetSharindataBundle:Currency")->findOneBy(array(
                                    'isoCodeNum' => (string)$e['iso_code_num']
                                )); 
                                if(!$currency){
                                    $currency = new \KkuetNet\SharindataBundle\Entity\Currency();
                                    $currency->setName((string)$e['name']);
                                    $currency->setIsoCode((string)$e['iso_code']);
                                    $currency->setIsoCodeNum((string)$e['iso_code_num']);
                                    $currency->setSign((string)$e['sign']);
                                    $currency->setConversionRate((double)$e['conversion_rate']);
                                    $currency->setBlank((string)$e['blank']);
                                    $currency->setDecimals((string)$e['decimals']);

                                    $currencyFormat = $this->em->getRepository("KkuetNetSharindataBundle:CurrencyFormat")->find((string)$e['format']);
                                    if($currencyFormat){
                                        $currency->setCurrencyFormat($currencyFormat);
                                    }
                                    $this->em->persist($currency);
                                    $this->em->flush();
                                }

                                $countryHasCurrency = new \KkuetNet\SharindataBundle\Entity\CountryHasCurrency();
                                $countryHasCurrency->setCountry($country);
                                $countryHasCurrency->setCurrency($currency);
                                $this->em->persist($countryHasCurrency);
                                $this->em->flush();
                            }
                        }

                        //Chargement des langues par pays
                        if($xml->languages){
                            foreach($xml->languages->children() as $l){
                                $language = $this->em->getRepository("KkuetNetSharindataBundle:Language")->findOneBy(array(
                                   'iso639_1'  => (string)$l['iso_code']
                                ));
                                if($language){
                                    $countryHasLanguage = new \KkuetNet\SharindataBundle\Entity\CountryHasLanguage();
                                    $countryHasLanguage->setCountry($country);
                                    $countryHasLanguage->setLanguage($language);
                                    $this->em->persist($countryHasLanguage);
                                }
                            }
                        }

                        //Chargement des taxes par pays
                        if($xml->taxes){
                            foreach($xml->taxes->children() as $t){
                                if(!$t->taxRule){
                                    $tax = new \KkuetNet\SharindataBundle\Entity\Tax();
                                    $tax->setName((string)$t['name']);
                                    $tax->setRate((string)$t['rate']);
                                    if($country){
                                        $tax->setCountry($country);
                                    }
                                    $this->em->persist($tax);
                                }
                            }
                        }
                    }
                }
            }
            closedir($handle);
        }
        $this->em->getConnection()->commit();
    }
    
    /**
     * Efface les données extrait des fichiers XML
     */
    public function clearApiData(){
        $currencies = $this->em->getRepository("KkuetNetSharindataBundle:Currency")->findAll();
        foreach($currencies as $c){
            $this->em->remove($c);
        }
        $countryHasLanguage = $this->em->getRepository("KkuetNetSharindataBundle:CountryHasLanguage")->findAll();
        foreach($countryHasLanguage as $chl){
            $this->em->remove($chl);
        }
        $this->em->flush();
    }
}

?>
