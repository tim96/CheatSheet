<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/30/2015
 * Time: 3:25 PM
 */

namespace Application\Sonata\UserBundle\Controller;

use Sonata\UserBundle\Controller\AdminSecurityController as BaseAdminSecurityController;
// use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Session;

class AdminSecurityController extends BaseAdminSecurityController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if ($user instanceof UserInterface) {
            $this->container->get('session')->getFlashBag()->set('sonata_user_error', 'sonata_user_already_authenticated');
            $url = $this->container->get('router')->generate('sonata_user_profile_show');

            return new RedirectResponse($url);
        }

        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->has('form.csrf_provider')
            ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;

        if ($this->container->get('security.context')->isGranted('ROLE_ADMIN')) {
            $refererUri = $request->server->get('HTTP_REFERER');

            return new RedirectResponse($refererUri && $refererUri != $request->getUri() ? $refererUri : $this->container->get('router')->generate('sonata_admin_dashboard'));
        }

        $login_fail = $request->getSession()->get('login_fail', 0);
        if ($login_fail >= 3) {
            $formFactory = $this->container->get('form.factory');
            $captcha = $formFactory->createBuilder('form', array(), array('csrf_protection' => false))
                ->add('captcha', 'captcha', array())
                ->getForm()
            ;
        }

        // todo: add PR for sonata user bundle
        return $this->container->get('templating')->renderResponse('SonataUserBundle:Admin:Security/login.html.'.$this->container->getParameter('fos_user.template.engine'), array(
            'captcha'       => isset($captcha) ? $captcha->createView() : null,
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token'    => $csrfToken,
            'base_template' => $this->container->get('sonata.admin.pool')->getTemplate('layout'),
            'admin_pool'    => $this->container->get('sonata.admin.pool')
        ));
    }

}