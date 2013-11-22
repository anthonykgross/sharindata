<?php

namespace KkuetNet\SharindataBundle\Security\Core\Authentication\Provider;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class Provider extends \Escape\WSSEAuthenticationBundle\Security\Core\Authentication\Provider\Provider
{
    private $userProvider;
    private $encoder;
    private $nonceDir;
    private $lifetime;

    /**
     * Constructor.
     *
     * @param UserProviderInterface    $userProvider              An UserProviderInterface instance
     * @param PasswordEncoderInterface $encoder                   A PasswordEncoderInterface instance
     * @param string                   $nonceDir                  The nonce dir
     * @param int                      $lifetime                  The lifetime
    */
    public function __construct(UserProviderInterface $userProvider, PasswordEncoderInterface $encoder, $nonceDir=null, $lifetime=300)
    {
        parent::__construct($userProvider, $encoder,$nonceDir, $lifetime);
        $this->userProvider = $userProvider;
        $this->encoder = $encoder;
        $this->nonceDir = $nonceDir;
        $this->lifetime = $lifetime;
    }
    
    protected function getSecret($user)
    {
        return $user->getPassword();
    }
    
    protected function validateDigest($user, $digest, $nonce, $created, $secret)
    {
        //expire timestamp after specified lifetime
        if(time() - strtotime($created) > $this->lifetime)
        {
            throw new CredentialsExpiredException('Token has expired.');
        }

        if($this->nonceDir)
        {
            $fs = new Filesystem();

            if(!$fs->exists($this->nonceDir))
            {
                $fs->mkdir($this->nonceDir);
            }

            //validate whether nonce is unique within specified lifetime
            if(
                file_exists($this->nonceDir.DIRECTORY_SEPARATOR.$nonce) &&
                file_get_contents($this->nonceDir.DIRECTORY_SEPARATOR.$nonce) + $this->lifetime < time()
            )
            {
                throw new NonceExpiredException('Previously used nonce detected.');
            }

            file_put_contents($this->nonceDir.'/'.$nonce, time());
        }

        //validate secret
        $expected       = base64_encode(sha1(base64_decode($nonce) . $created . $secret, true));
        
        return $digest === $expected;
    }
}