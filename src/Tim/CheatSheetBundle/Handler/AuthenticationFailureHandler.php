<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 30.08.2015
 * Time: 19:30
 */

namespace Tim\CheatSheetBundle\Handler;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationFailureHandler;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationFailureHandler extends DefaultAuthenticationFailureHandler
{
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set('login_fail', $request->getSession()->get('login_fail', 0) + 1);

        return parent::onAuthenticationFailure($request, $exception);
    }
}