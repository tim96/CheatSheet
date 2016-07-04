<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/4/2016
 * Time: 8:08 PM
 */

namespace Tim\ExampleBundle\Service;

use Doctrine\ORM\EntityManager;
use Tim\ExampleBundle\Repository\BookRepository;

class BookService
{
    /** @var  BookRepository */
    protected $bookRepository;

    /** @var  EntityManager */
    protected $em;

    public function __construct($entityManager, $bookRepositoryName)
    {
        $this->em = $entityManager;
        $this->bookRepository = $this->em->getRepository($bookRepositoryName);
    }

    /**
     * @return BookRepository
     */
    public function getOrdersRepository()
    {
        return $this->bookRepository;
    }

    public function getListQuery($limit)
    {
        return $this->bookRepository->getListWithParameters($limit);
    }
}