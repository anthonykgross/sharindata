<?php

namespace KkuetNet\SharindataBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends \FOS\UserBundle\Controller\RegistrationController
{
    public function registerAction()
    {
        $form                   = $this->container->get('fos_user.registration.form');
        $formHandler            = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled    = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url        = $this->container->get('router')->generate($route);
            $response   = new RedirectResponse($url);

            $apikey     = $this->container->get('sharindata_tool_randomize')->getRandom(20, 2);
            
            $u          = true;
            while(!is_null($u)){
                $apikey     = $this->container->get('sharindata_tool_randomize')->getRandom(20, 2);
                $u          = $this->container->get('doctrine')->getEntityManager()->getRepository("KkuetNetSharindataBundle:User")->findOneBy(array(
                    'api_key' => $apikey
                ));
            }
                
            $user->setApiKey($apikey);
            $user->setApiSecret($this->container->get('sharindata_tool_randomize')->getRandom(20, 2));
            $user->setHashKey($this->container->get('sharindata_tool_randomize')->getRandom(20, 2));
            
            $em         = $this->container->get('doctrine')->getEntityManager();
            $em->persist($user);
            $em->flush();
            
            if ($authUser) {
                $this->authenticateUser($user, $response);
            }
            
            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.'.$this->getEngine(), array(
            'form' => $form->createView(),
        ));
    }
}