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

                $hex = $this->container->get('sharindata_tool_color')->RGBToHex($colors['red'], $colors['green'], $colors['blue']);
             
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
}

?>
