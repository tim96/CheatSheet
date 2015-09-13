<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 30.08.2015
 * Time: 19:30
 */

namespace Tim\CheatSheetBundle\Handler;

use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // brake captcha value
        $request->getSession()->set('login_fail', 0);

        if ($token->getUser()->hasRole('ROLE_USER')) {
            return new RedirectResponse($this->httpUtils->generateUri($request, '/'));
        }

        if ($token->getUser()->hasRole('ROLE_ADMIN')) {
            return new RedirectResponse($this->httpUtils->generateUri($request, 'sonata_admin_dashboard'));
        }
        // return new RedirectResponse($this->httpUtils->generateUri($request, 'sonata_admin_dashboard'));
        return parent::onAuthenticationSuccess($request, $token);
    }
}