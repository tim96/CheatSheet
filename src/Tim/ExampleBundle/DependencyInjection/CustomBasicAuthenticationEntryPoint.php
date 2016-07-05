<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/5/2016
 * Time: 8:42 PM
 */

namespace Tim\ExampleBundle\DependencyInjection;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;

class CustomBasicAuthenticationEntryPoint implements AuthenticationEntryPointInterface
{
    /**
     * Returns a response that directs the user to authenticate.
     *
     * This is called when an anonymous request accesses a resource that
     * requires authentication. The job of this method is to return some
     * response that "helps" the user start into the authentication process.
     *
     * Examples:
     *  A) For a form login, you might redirect to the login page
     *      return new RedirectResponse('/login');
     *  B) For an API token authentication system, you return a 401 response
     *      return new Response('Auth header required', 401);
     *
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $content = array('success' => false, 'error' => 401);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($content))
            ->setStatusCode(401)
        ;

        return $response;
    }

    # How to configure http_basic firewall in Symfony to return JSON in response body
    # 1. Create this class
    # 2. Add this class to service definition
    # 3. Add class service definition to security.yml
    # firewalls:
    #     main:
    #         entry_point: custom_basic_authentication_entry_point
}