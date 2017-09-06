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

class RandomizeController extends Controller
{
    /**
     * Return random string
     * @RequestParam(name="length", requirements="[0-9]{1,}", description="Length of random string")
     * @RequestParam(name="option", requirements="[0-3]{1}", default="0", description="<ul>
    <li>0: Alpha Lower</li>
    <li>1: Alpha Lower+Alpha Upper</li>
    <li>2: Alpha Lower+Alpha Upper+Numeric</li>
    <li>3: Alpha Lower+Alpha Upper+Numeric+Special Char</li>
</ul>") 
     * @ApiDoc(section="Randomize")
     * @Rest\View()
     */
    public function postRandomStringAction(ParamFetcher $paramFetcher)
    {
        return array(
            'random' => $this->container->get('sharindata_tool_randomize')->getRandom($paramFetcher->get('length'),$paramFetcher->get('option'))
        );
    }
}
