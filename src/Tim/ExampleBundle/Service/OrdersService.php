<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/25/2016
 * Time: 7:57 PM
 */

namespace Tim\ExampleBundle\Service;

use Doctrine\ORM\EntityManager;
use Tim\ExampleBundle\Repository\OrdersRepository;

class OrdersService
{
    /** @var  OrdersRepository */
    protected $ordersRepository;

    /** @var  EntityManager */
    protected $em;

    public function __construct($entityManager, $ordersRepositoryName)
    {
        $this->em = $entityManager;
        $this->ordersRepository = $this->em->getRepository($ordersRepositoryName);
    }

    /**
     * @return OrdersRepository
     */
    public function getOrdersRepository()
    {
        return $this->ordersRepository;
    }

    public function getOrdersListAsArray($ids)
    {
        return $this->ordersRepository->getByIds($ids)->getQuery()->getArrayResult();
    }
}