<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 31.07.2015
 * Time: 23:21
 */

namespace Tim\CheatSheetBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class BaseHandler
{
    /** @var  ContainerInterface */
    protected $container;
    /** @var  ObjectManager */
    protected $om;
    /** @var  string */
    protected $entityClass;

    protected $repository;
    /** @var  UserInterface */
    protected $user;

    public function __construct(ContainerInterface $container, ObjectManager $om, $entityClass)
    {
        $this->container = $container;
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function getManager()
    {
        return $this->om;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}