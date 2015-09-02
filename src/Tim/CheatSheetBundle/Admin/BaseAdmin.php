<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 31.08.2015
 * Time: 20:01
 */

namespace Tim\CheatSheetBundle\Admin;

use Monolog\Logger;
use Sonata\AdminBundle\Admin\Admin;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Application\Sonata\UserBundle\Entity\User;
use Sonata\AdminBundle\Datagrid\ListMapper;

abstract class BaseAdmin extends Admin
{
    /** @var \Monolog\Logger $logger */
    private $logger;
    /** @var ContainerInterface */
    protected $container;

    public function __construct($code, $class, $baseControllerName, $container = null)
    {
        parent::__construct($code, $class, $baseControllerName);

        $this->container = $container;
        $this->logger = $this->container->get('logger');
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function getContainer()
    {
        return $this->container;
    }

    protected function getUser()
    {
        /** @var User $user */
        return $this->container->get('security.token_storage')->getToken()->getUser();
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        unset($this->listModes['mosaic']);
    }
}