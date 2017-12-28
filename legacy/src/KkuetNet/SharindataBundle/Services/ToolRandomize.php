<?php
namespace KkuetNet\SharindataBundle\Services;

class ToolRandomize {

    private $container  = null;
    private $em         = null;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Return random string
     * @param int $length = length of random string
     * @param type $option = 
     * 0: Alpha Lower
     * 1: Alpha Lower+Alpha Upper
     * 2: Alpha Lower+Alpha Upper+Numeric
     * 3: Alpha Lower+Alpha Upper+Numeric+Special Char
     * @return string
     */
    public function getRandom($length = 55, $option = 3){
        $alpha_lower = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha_lower);
        $numeric     = "1234567890";
        $special_char= "&~#\"'{([-|_\^@)]=}\$*%!/;?.,";
        
        $chars = "";
        switch($option){
            case 0: $chars = $alpha_lower;break;
            case 1: $chars = $alpha_lower.$alpha_upper;break;
            case 2: $chars = $alpha_lower.$alpha_upper.$numeric;break;
            case 3: $chars = $alpha_lower.$alpha_upper.$numeric.$special_char;break;
        }
        
        $random = "";
        for($i = 0 ; $i < $length; $i++){
            $random .= substr($chars, rand(0, strlen($chars)-1), 1);
        }
        
        return str_shuffle($random);
    }
}