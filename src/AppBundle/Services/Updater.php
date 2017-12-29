<?php
namespace AppBundle\Services;

use AppBundle\Entity\Country;
use AppBundle\Entity\CountryHasCurrency;
use AppBundle\Entity\CountryHasLanguage;
use AppBundle\Entity\Currency;
use AppBundle\Entity\CurrencyFormat;
use AppBundle\Entity\Language;
use AppBundle\Entity\Tax;
use Doctrine\ORM\EntityManager;

class Updater
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     *
     */
    public function purgeCache()
    {
        $countries = $this->em->getRepository(Country::class)->findAll();

        /**
         * @var $countries Country[]
         */
        foreach ($countries as $c) {
            $content = @file_get_contents("http://api.prestashop.com/localization/15/" . strtolower($c->getIso()) . ".xml");

            if ($content) {
                echo strtolower($c->getIso()) . ".xml : Ok\n";
                file_put_contents(__DIR__ . "/../XML/cache/api/" . strtolower($c->getIso()) . ".xml", $content);
            } else {
                echo strtolower($c->getIso()) . ".xml : Fail\n";
            }
        }
    }

    /**
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function importXml()
    {
        $this->em->getConnection()->beginTransaction();
        $this->clearApiData();

        if ($handle = opendir(__DIR__ . "/../XML/cache/api/")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && $entry != ".svn") {
                    $xml = simplexml_load_file(__DIR__ . "/../XML/cache/api/" . $entry);

                    /**
                     * @var $country Country
                     */
                    $country = $this->em->getRepository(Country::class)->findOneBy(array(
                        "iso" => str_replace(".xml", "", $entry)
                    ));

                    if ($country) {
                        if ($xml->currencies) {
                            foreach ($xml->currencies->children() as $e) {
                                $currency = $this->em->getRepository(Currency::class)->findOneBy(array(
                                    'isoCodeNum' => (string)$e['iso_code_num']
                                ));
                                if (!$currency) {
                                    $currency = new Currency();
                                    $currency->setName((string)$e['name']);
                                    $currency->setIsoCode((string)$e['iso_code']);
                                    $currency->setIsoCodeNum((string)$e['iso_code_num']);
                                    $currency->setSign((string)$e['sign']);
                                    $currency->setConversionRate((double)$e['conversion_rate']);
                                    $currency->setBlank((string)$e['blank']);
                                    $currency->setDecimals((string)$e['decimals']);

                                    /**
                                     * @var $currencyFormat CurrencyFormat
                                     */
                                    $currencyFormat = $this->em->getRepository(CurrencyFormat::class)->find((string)$e['format']);
                                    if ($currencyFormat) {
                                        $currency->setCurrencyFormat($currencyFormat);
                                    }
                                    $this->em->persist($currency);
                                    $this->em->flush();
                                }

                                $countryHasCurrency = new CountryHasCurrency();
                                $countryHasCurrency->setCountry($country);
                                $countryHasCurrency->setCurrency($currency);
                                $this->em->persist($countryHasCurrency);
                                $this->em->flush();
                            }
                        }

                        if ($xml->languages) {
                            foreach ($xml->languages->children() as $l) {
                                /**
                                 * @var $language Language
                                 */
                                $language = $this->em->getRepository(Language::class)->findOneBy(array(
                                    'iso639_1' => (string)$l['iso_code']
                                ));
                                if ($language) {
                                    $countryHasLanguage = new CountryHasLanguage();
                                    $countryHasLanguage->setCountry($country);
                                    $countryHasLanguage->setLanguage($language);
                                    $this->em->persist($countryHasLanguage);
                                }
                            }
                        }

                        if ($xml->taxes) {
                            foreach ($xml->taxes->children() as $t) {
                                if (!$t->taxRule) {
                                    $tax = new Tax();
                                    $tax->setName((string)$t['name']);
                                    $tax->setRate((string)$t['rate']);
                                    if ($country) {
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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function clearApiData()
    {
        $currencies = $this->em->getRepository(Currency::class)->findAll();
        foreach ($currencies as $c) {
            $this->em->remove($c);
        }
        $countryHasLanguage = $this->em->getRepository(CountryHasLanguage::class)->findAll();
        foreach ($countryHasLanguage as $chl) {
            $this->em->remove($chl);
        }
        $taxes = $this->em->getRepository(Tax::class)->findAll();
        foreach ($taxes as $t) {
            $this->em->remove($t);
        }
        $this->em->flush();
    }
}