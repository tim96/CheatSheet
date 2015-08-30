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

abstract class BaseHandler extends BaseContainerEmHandler
{
    /** @var  string */
    protected $entityClass;
    /** @var  UserInterface */
    protected $user;
    protected $repository;

    public function __construct(ContainerInterface $container, ObjectManager $om, $entityClass)
    {
        parent::__construct($container, $om);

        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
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