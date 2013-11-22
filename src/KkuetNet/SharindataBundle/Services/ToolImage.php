<?php
namespace KkuetNet\SharindataBundle\Services;

class ToolImage {

    private $container  = null;
    private $em         = null;
    
    public function __construct($container){
        $this->container    = $container;
        $this->em           = $container->get('doctrine')->getManager();
    }
    
    /**
     * Retourne les infos d'une image
     * @param type $path
     * @return type
     */
    public function getImageFromPath($path){
        $imageSize  = getimagesize($path);
        $imageW     = $imageSize[0];
        $imageH     = $imageSize[1];
        $ext        = $imageSize["mime"];
        $img        = null;
        
        switch($ext){
            case "image/png" :$img = imagecreatefrompng($path);break;
            case "image/gif" :$img = imagecreatefromgif($path);break;
            case "image/jpeg":$img = imagecreatefromjpeg($path);break;
        }
        
        return array(
            'mime'      => $ext,
            'width'     => $imageW, 
            'height'    => $imageH,
            'obj'       => $img
        );
    }
    
    /**
     * True si le format du fichier est une image
     * @param type $path
     * @return type
     */
    public function isValid($path){
        $infosImage = $this->getImageFromPath($path);
        return ($infosImage['obj']!==null);
    }
    
    /**
     * Retourne la liste des couleurs classées de la plus fréquente à la moin.
     * @param type $path : path de l'image
     * @return int
     */
    public function getAllColors($path){
        $infosImage = $this->getImageFromPath($path);
        $data       = array();
        
        for($i = 0; $i < $infosImage['width']; $i++){
            for($j = 0; $j < $infosImage['height']; $j++){
                $rgb        = imagecolorat($infosImage['obj'], $i, $j);
                $colors     = imagecolorsforindex($infosImage['obj'], $rgb);

                $hex = $this->RGBToHex($colors['red'], $colors['green'], $colors['blue']);
             
                if(key_exists($hex, $data)){
                    $data[$hex] +=1;
                }
                else{
                    $data[$hex] = 1;
                }
            }  
        }
        arsort($data);
        return $data;
    }
    
    /**
     * Retourne les nbColors princpales couleurs
     * @param type $path : path de l'image
     * @param type $nbColors : Nombre de couleurs principales souhaitees
     * @return Array
     */
    public function getMainsColors($path, $nbColors){
        $colors         = $this->getAllColors($path);
        $data           = array();
        
        $colorsSorted   = $colors;

        foreach($colorsSorted as $k => $v){
            if(count($data) < $nbColors){
                $data[$k] = $v;
            }
        }
        
        return $data;
    }
    
    /**
     * Converti une couleur RGB en Hexa
     * @param type $r
     * @param type $g
     * @param type $b
     * @return type
     */
    public function RGBToHex($r,$g,$b){
        $hex_RGB    = "#";
        $hex_r      = str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $hex_g      = str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $hex_b      = str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
        $hex_RGB    .=$hex_r.$hex_g.$hex_b;
        return strtoupper($hex_RGB);
    }
    
    public function HexToR($h){return hexdec(substr(self::cutHex($h),0,2));}
    public function HexToG($h){return hexdec(substr(self::cutHex($h),2,2));}
    public function HexToB($h){return hexdec(substr(self::cutHex($h),4,2));}
    private function cutHex($h){return (substr($h, 0, 1)=="#") ? substr($h,1,7):$h;}
}

?>
