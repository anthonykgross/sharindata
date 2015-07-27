<?php

namespace KkuetNet\SharindataBundle\Security\Core\Authentication\Provider;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class Provider extends \Escape\WSSEAuthenticationBundle\Security\Core\Authentication\Provider\Provider
{
    protected function getSecret(UserInterface $user)
    {
        return hash_hmac('sha512', $user->getApiSecret() , $user->getHashKey());
    }
}