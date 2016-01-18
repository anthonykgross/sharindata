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

class ImageController extends Controller
{
    /**
     * Returns mains colors from Image
     * @ApiDoc(section="Image")
     * @RequestParam(name="image", requirements="[a-z]{1,}", description="Image file path with '@' before. Ex : @/home/sharindata/image.png")
     * @RequestParam(name="nbColor", requirements="[0-9]{1,}", default="2", description="Max number of colors to return (default : 2). Ex : 5")
     * @Rest\View()
     */
    public function postImageMaincolorsAction(ParamFetcher $paramFetcher)
    {
        $em         = $this->getDoctrine()->getManager();
        $request    = $this->get('request');
        $image      = $request->files->get('image');
        
        $image->move(__DIR__."/../Temp/", $image->getClientOriginalName());
        $imagePath  = __DIR__."/../Temp/".$image->getClientOriginalName();

        if($this->container->get('sharindata_tool_image')->isValid($imagePath)){
            $data = $this->container->get('sharindata_tool_image')->getMainsColors($imagePath, $paramFetcher->get('nbColor'));
            unlink($imagePath);
            return $data;
        }
        else{
            throw new \Exception("Invalid image extension (Only .png, .gif or .jpg");
        }
    }
    
    /**
     * Returns all colors from image
     * @ApiDoc(section="Image")
     * @RequestParam(name="image", requirements="[a-z]{1,}", description="Image file path with '@' before. Ex : @/home/sharindata/image.png")
     * @Rest\View()
     */
    public function postImageAllcolorsAction(ParamFetcher $paramFetcher)
    {
        $em         = $this->getDoctrine()->getManager();
        $request    = $this->get('request');
        $image      = $request->files->get('image');
        
        $image->move(__DIR__."/../Temp/", $image->getClientOriginalName());
        $imagePath  = __DIR__."/../Temp/".$image->getClientOriginalName();

        if($this->container->get('sharindata_tool_image')->isValid($imagePath)){
            $data = $this->container->get('sharindata_tool_image')->getAllColors($imagePath);
            unlink($imagePath);
            return $data;
        }
        else{
            throw new \Exception("Invalid image extension (Only .png, .gif or .jpg");
        }
    }
}
