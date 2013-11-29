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

class UnclassifiableController extends Controller
{
    /**
     * Returns user agent details
     * @ApiDoc(section="Unclassifiable")
     * @RequestParam(name="user_agent", description="User agent information Ex: ")
     * @RequestParam(name="accept", description="User agent information Ex: ")
     * @RequestParam(name="wap_profile", nullable=true, default=null, description="User agent information Ex: ")
     * @RequestParam(name="profile", nullable=true, default=null, description="User agent information Ex: ")
     * @Rest\View()
     */
    public function postUseragentDetailsAction(ParamFetcher $paramFetcher)
    {
        if($paramFetcher->get('user_agent') && strlen($paramFetcher->get('user_agent'))>0){
            return json_decode(json_encode(\KkuetNet\SharindataBundle\Vendor\UAParser::parse($paramFetcher->get('user_agent'))),true);
        }
        else{
            return array(
                'code' => 500,
                'message' => 'Wrong User Agent'
            );
        }
    }
}
