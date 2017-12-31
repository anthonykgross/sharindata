<?php
namespace AppBundle\Service;

class Image
{

    /**
     * @var Color
     */
    private $serviceColor;

    /**
     * Image constructor.
     * @param Color $serviceColor
     */
    public function __construct(Color $serviceColor)
    {
        $this->serviceColor = $serviceColor;
    }

    /**
     * @param $path
     * @return array
     */
    public function getImageFromPath($path)
    {
        $imageSize = getimagesize($path);
        $imageW = $imageSize[0];
        $imageH = $imageSize[1];
        $ext = $imageSize["mime"];
        $img = null;

        switch ($ext) {
            case "image/png" :
                $img = imagecreatefrompng($path);
                break;
            case "image/gif" :
                $img = imagecreatefromgif($path);
                break;
            case "image/jpeg":
                $img = imagecreatefromjpeg($path);
                break;
        }

        return array(
            'mime' => $ext,
            'width' => $imageW,
            'height' => $imageH,
            'obj' => $img
        );
    }

    /**
     * @param $path
     * @return bool
     */
    public function isValid($path)
    {
        $infosImage = $this->getImageFromPath($path);
        return ($infosImage['obj'] !== null);
    }

    /**
     * @param $path
     * @return array
     */
    public function getAllColors($path)
    {
        $infoImage = $this->getImageFromPath($path);
        $data = array();

        for ($i = 0; $i < $infoImage['width']; $i++) {
            for ($j = 0; $j < $infoImage['height']; $j++) {
                $rgb = imagecolorat($infoImage['obj'], $i, $j);
                $colors = imagecolorsforindex($infoImage['obj'], $rgb);

                $hex = $this->serviceColor->RGBToHex($colors['red'], $colors['green'], $colors['blue']);

                if (key_exists($hex, $data)) {
                    $data[$hex] += 1;
                } else {
                    $data[$hex] = 1;
                }
            }
        }
        arsort($data);
        return $data;
    }

    /**
     * @param $path
     * @param $nbColors
     * @return array
     */
    public function getMainsColors($path, $nbColors)
    {
        $colors = $this->getAllColors($path);
        $data = array();

        $colorsSorted = $colors;

        foreach ($colorsSorted as $k => $v) {
            if (count($data) < $nbColors) {
                $data[$k] = $v;
            }
        }

        return $data;
    }
}