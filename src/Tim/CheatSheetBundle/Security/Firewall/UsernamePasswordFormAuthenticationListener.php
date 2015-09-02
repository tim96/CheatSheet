<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 02.09.2015
 * Time: 20:00
 */

namespace Tim\CheatSheetBundle\Security\Firewall;

use Symfony\Component\Security\Http\Firewall\UsernamePasswordFormAuthenticationListener as BaseUsernamePasswordFormAuthenticationListener;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\LockedException;

class UsernamePasswordFormAuthenticationListener extends BaseUsernamePasswordFormAuthenticationListener
{
    /**
     * {@inheritdoc}
     */
    protected function attemptAuthentication(Request $request)
    {
        $login_fail = $request->getSession()->get('login_fail', 0);

        // todo: add check for captcha exists in session
        if ($login_fail > 0) {
            $rightCaptcha = $request->getSession()->get('gcb_captcha');
            if (!isset($rightCaptcha['phrase'])) {
                throw new LockedException('captcha_error_message');
            }

            $captcha = $request->request->get('form');
            if (!isset($captcha['captcha'])) {
                throw new LockedException('captcha_error_message');
            }

            if ($captcha['captcha'] != $rightCaptcha['phrase']) {
                throw new LockedException('captcha_compare_error_message');
            }
        }

        return parent::attemptAuthentication($request);
    }
}
