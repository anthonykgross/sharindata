<?php

namespace KkuetNet\SharindataBundle\Controller;

use KkuetNet\SharindataBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;


/**
 * Controller that provides Restfuls security functions.
 *
 */
class SecurityController extends Controller
{

    /**
     * Create a WSSE token
     * @QueryParam(name="_apikey", requirements="(.*)", strict=true, description="Your Sharindata API Key")
     * @QueryParam(name="_apisecret", requirements="(.*)", strict=true, description="Your Sharindata API Secret")
     * @ApiDoc(section="API")
     */
    public function postAction(ParamFetcher $paramFetcher)
    {
        $apikey         = $paramFetcher->get('_apikey');
        $apisecret      = $paramFetcher->get('_apisecret');
        $user           = $this->container->get('doctrine')->getManager()->getRepository("KkuetNetSharindataBundle:User")->findOneBy(array(
            'api_key' => $apikey
        ));

        if (!$user instanceof User) {
            return array(
                'code' => 500,
                'message' => 'Wrong API Key'
            );
        }
        
        if ($user->getApiSecret() !== $apisecret) {
            return array(
                'code' => 500,
                'message' => 'Wrong API Secret'
            );
        }
        
        $created        = date('c');
        $nonce          = substr(md5(uniqid('nonce_', true)), 0, 16);
        $nonceHigh      = base64_encode($nonce);

        $password       = hash_hmac('sha512', $user->getApiSecret() , $user->getHashKey());
        $passwordDigest = base64_encode(sha1($nonce . $created .$password, true));
        $header         = "UsernameToken Username=\"{$user->getEmail()}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonceHigh}\", Created=\"{$created}\"";
        
        $view       = new \Symfony\Component\HttpFoundation\JsonResponse(array('WSSE' => $header));
        $view->headers->set("Authorization", 'WSSE profile="UsernameToken"');
        $view->headers->set("X-WSSE", $header);

        return $view;
    }

    /**
     * Destroy current WSSE token
     * @return FOSView
     * @ApiDoc(section="API")
     */
    public function getDestroyAction()
    {
        $security   = $this->get('security.context');
        $token      = new AnonymousToken(null, new User());
        $security->setToken($token);
        $this->get('session')->invalidate();
        $view       = new \Symfony\Component\HttpFoundation\JsonResponse(array('statusCode' => 200));
        return $view;
    }
}