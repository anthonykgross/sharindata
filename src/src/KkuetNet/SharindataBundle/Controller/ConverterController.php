<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;

class ConverterController extends Controller
{
    /**
     * Return Hex color code
     * @RequestParam(name="red", requirements="[0-9]{1,3}", default="0", description="red value (0-255)")
     * @RequestParam(name="green", requirements="[0-9]{1,3}", default="0", description="green value (0-255)") 
     * @RequestParam(name="blue", requirements="[0-9]{1,3}", default="0", description="blue value (0-255)") 
     * @ApiDoc(section="Converter")
     * @Rest\View()
     */
    public function postColorRgbtohexAction(ParamFetcher $paramFetcher)
    {
        return array(
            'hex' => $this->container->get('sharindata_tool_color')->RGBToHex($paramFetcher->get('red'),$paramFetcher->get('green'), $paramFetcher->get('blue'))
        );
    }
    
    /**
     * Return Rgb color code
     * @RequestParam(name="hex", strict=true, requirements="^\#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$", default="0", description="Hex color code prefixed by #")
     * @ApiDoc(section="Converter")
     * @Rest\View()
     */
    public function postColorHextorgbAction(ParamFetcher $paramFetcher)
    {
        return $this->container->get('sharindata_tool_color')->HexToRGB($paramFetcher->get('hex'));
    }
}
