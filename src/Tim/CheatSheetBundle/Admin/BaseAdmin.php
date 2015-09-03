<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 31.08.2015
 * Time: 20:01
 */

namespace Tim\CheatSheetBundle\Admin;

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

    public function __construct($code, $class, $baseControllerName, ContainerInterface $container)
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

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        parent::prePersist($object);

        $user = $this->getUser();
        if (method_exists($object, 'setCreatedAt')) {
            $object->setCreatedAt(new \DateTime('now'));
        }
        if (method_exists($object, 'setAuthor')) {
            $object->setAuthor($user);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        parent::preUpdate($object);

        $user = $this->getUser();
        if (method_exists($object, 'setUpdatedAt')) {
            $object->setUpdatedAt(new \DateTime('now'));
        }
        if (method_exists($object, 'setAuthor')) {
            $object->setAuthor($user);
        }
    }

    public function postPersist($object)
    {

    }

    public function postUpdate($object)
    {

    }
}