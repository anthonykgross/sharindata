<?php
namespace AppBundle\Service;

class Color
{
    /**
     * @param string $r
     * @param string $g
     * @param string $b
     * @return string
     */
    public function RGBToHex($r, $g, $b)
    {
        $hex_RGB = "#";
        $hex_r = str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $hex_g = str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $hex_b = str_pad(dechex($b), 2, "0", STR_PAD_LEFT);
        $hex_RGB .= $hex_r . $hex_g . $hex_b;
        return strtoupper($hex_RGB);
    }

    /**
     * @param string $hex
     * @return array
     */
    public function HexToRGB($hex)
    {
        $hex = $this->getFullHex($hex);

        return array(
            'r' => $this->HexToR($hex),
            'g' => $this->HexToG($hex),
            'b' => $this->HexToB($hex)
        );
    }

    /**
     * @param $h
     * @return float|int
     */
    public function HexToR($h)
    {
        return hexdec(substr($this->cutHex($h), 0, 2));
    }

    /**
     * @param $h
     * @return float|int
     */
    public function HexToG($h)
    {
        return hexdec(substr($this->cutHex($h), 2, 2));
    }

    /**
     * @param $h
     * @return float|int
     */
    public function HexToB($h)
    {
        return hexdec(substr($this->cutHex($h), 4, 2));
    }

    /**
     * @param $h
     * @return bool|string
     */
    private function cutHex($h)
    {
        return (substr($h, 0, 1) == "#") ? substr($h, 1, 7) : $h;
    }

    /**
     * @param $h
     * @return bool|string
     */
    private function getFullHex($h)
    {
        $h = $this->cutHex($h);
        if (strlen($h) == 3) {
            $h = substr($h, 0, 1) . substr($h, 0, 1) . substr($h, 1, 1) . substr($h, 1, 1) . substr($h, 2, 1) . substr($h, 2, 1);
        }
        return $h;
    }
}
