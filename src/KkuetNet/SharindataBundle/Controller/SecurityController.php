<?php

namespace KkuetNet\SharindataBundle\Controller;

use KkuetNet\SharindataBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\Route; 
use FOS\RestBundle\Controller\Annotations\Post; 
use FOS\RestBundle\Controller\Annotations\Get; 
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;  
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller that provides Restfuls security functions.
 *
 */
class SecurityController extends Controller
{

    /**
     * Create a WSSE token
     * @QueryParam(name="_username", requirements="(.*)", strict=true, description="Your Sharindata email")
     * @QueryParam(name="_password", requirements="(.*)", strict=true, description="Your Sharindata password")
     * @ApiDoc(section="API")
     */
    public function postTokenCreateAction(ParamFetcher $paramFetcher)
    {
        $view       = new Response();
        $username   = $paramFetcher->get('_username');
        $password   = $paramFetcher->get('_password');
        $um         = $this->get('fos_user.user_manager');
        $user       = $um->findUserByUsernameOrEmail($username);

        if (!$user instanceof User) {
            throw new AccessDeniedException("Wrong user");
        }

        $created        = date('c');
        $nonce          = substr(md5(uniqid('nonce_', true)), 0, 16);
        $nonceHigh      = base64_encode($nonce);
        $passwordDigest = base64_encode(sha1($nonce . $created . $password . "{".$user->getSalt()."}", true));
        $header         = "UsernameToken Username=\"{$username}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonceHigh}\", Created=\"{$created}\"";
        $view->headers->set("Authorization", 'WSSE profile="UsernameToken"');
        $view->headers->set("X-WSSE", "UsernameToken Username=\"{$username}\", PasswordDigest=\"{$passwordDigest}\", Nonce=\"{$nonceHigh}\", Created=\"{$created}\"");
        $data = array('WSSE' => $header);
        $view->setContent($data);
        
        return $view;
    }

    /**
     * Destroy current WSSE token
     * @return FOSView
     * @ApiDoc(section="API")
     */
    public function getTokenDestroyAction()
    {
        $security   = $this->get('security.context');
        $token      = new AnonymousToken(null, new User());
        $security->setToken($token);
        $this->get('session')->invalidate();
        return array(
            'statusCode' => 200
        );
    }
}