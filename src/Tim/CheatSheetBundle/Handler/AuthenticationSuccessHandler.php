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

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler
{
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // brake captcha value
        // $request->getSession()->set('login_fail', 0);

        return parent::onAuthenticationSuccess($request, $token);
    }
}