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
        $login_fail = $request->getSession()->get('login_failed_count', 0);
        $login_fail++;

        $request->getSession()->set('login_fail', $login_fail);

        if ($login_fail <= 3) {
            // todo: add captcha processing
        }

        return parent::onAuthenticationFailure($request, $exception);
    }
}