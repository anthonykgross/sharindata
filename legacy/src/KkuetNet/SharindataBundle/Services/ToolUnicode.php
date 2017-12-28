<?php
namespace KkuetNet\SharindataBundle\Services;

class ToolUnicode {

    private $container  = null;
    private $em         = null;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    public function HtmlToUtf8($str){
        return html_entity_decode($str, ENT_COMPAT, 'UTF-8');
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
    
    public function Utf8ToForcedUnicode($str){
        if (!mb_check_encoding($str, 'UTF-8')) {
            return null;
        }
        return preg_replace_callback('/./u', function ($m) {
            $ord = ord($m[0]);
            if ($ord <= 127) {
                return sprintf('\u%04x', $ord);
            } else {
                return trim(json_encode($m[0]), '"');
            }
        }, $str);
    }
    
    public function Utf8ToHex($str){
        return bin2hex($str);
    }
    
    public function HexToUtf8($str){
        return pack('H*', $str);
    }
    
    function utf8_to_unicode( $str ) {
        $unicode = array();        
        $values = array();
        $lookingFor = 1;

        for ($i = 0; $i < strlen( $str ); $i++ ) {
            $thisValue = ord( $str[ $i ] );
        if ( $thisValue < ord('A') ) {
            // exclude 0-9
            if ($thisValue >= ord('0') && $thisValue <= ord('9')) {
                 // number
                 $unicode[] = chr($thisValue);
            }
            else {
                 $unicode[] = '%'.dechex($thisValue);
            }
        } else {
              if ( $thisValue < 128) 
            $unicode[] = $str[ $i ];
              else {
                    if ( count( $values ) == 0 ) $lookingFor = ( $thisValue < 224 ) ? 2 : 3;                
                    $values[] = $thisValue;                
                    if ( count( $values ) == $lookingFor ) {
                        $number = ( $lookingFor == 3 ) ?
                            ( ( $values[0] % 16 ) * 4096 ) + ( ( $values[1] % 64 ) * 64 ) + ( $values[2] % 64 ):
                            ( ( $values[0] % 32 ) * 64 ) + ( $values[1] % 64 );
                $number = dechex($number);
                $unicode[] = (strlen($number)==3)?"%u0".$number:"%u".$number;
                        $values = array();
                        $lookingFor = 1;
              } // if
            } // if
        }
        } // for
        return implode("",$unicode);

    } 
}

?>
