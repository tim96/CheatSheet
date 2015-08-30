<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/30/2015
 * Time: 3:25 PM
 */

namespace Application\Sonata\UserBundle\Controller;

use Sonata\UserBundle\Controller\AdminSecurityController as BaseAdminSecurityController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminSecurityController extends BaseAdminSecurityController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return parent::loginAction();
    }
}