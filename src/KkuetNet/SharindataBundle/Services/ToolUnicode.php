<?php
namespace KkuetNet\SharindataBundle\Services;

class ToolUnicode {

    private $container  = null;
    private $em         = null;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function Utf8ToHtml($str){
        $str = $this->Utf8ToUnicode($str);
        return preg_replace('/\\\\u([0-9a-z]{4})/', '&#x$1;', $str);
    }
    
    public function UnicodetoUtf8($str){
        $str = str_replace('"', '\\"', $str);
        return json_decode('"'.$str.'"');
    }
    
    public function Utf8ToUnicode($str){
        return substr(json_encode($this->UnicodetoUtf8($str), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP),1,-1);
    }
    
    public function Utf8ToHex($str){
        return bin2hex($str);
    }
    
    public function HexToUtf8($str){
        return pack('H*', $str);
    }
}

?>
