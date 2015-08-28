<?php
/**
 * Created by PhpStorm.
 * User: alexander.timofeev
 * Date: 28.08.2015
 * Time: 14:20
 */

namespace Tim\CheatSheetBundle\Controller\v2;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ApiAuthController extends Controller
{
    /**
     * @Route("/login", name="v2_api_auth_login")
     * @Template()
     */
    public function loginAction(Request $request)
    {
        // todo: add login logic
    }

    /**
     * @Route("/logout", name="v2_api_auth_logout")
     * @Template()
     */
    public function logoutAction(Request $request)
    {
        // todo: add logout logic
    }
}