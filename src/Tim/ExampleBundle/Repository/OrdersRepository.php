<?php

namespace Tim\ExampleBundle\Repository;

/**
 * OrdersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrdersRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param array $ids
     *
     * @return \Doctrine\ORM\QueryBuilder
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function getByIds($ids = array())
    {
        $query = $this->createQueryBuilder('o');

        if (count($ids) > 0) {
            $query
                ->andWhere('o.id IN (:ids)')
                ->setParameter('ids', array_values($ids))
            ;
        }

        // Add example how to use beberlei DoctrineExtensions
        // $emConfig = $this->getEntityManager()->getConfiguration();
        // $emConfig->addCustomDatetimeFunction('timestampdiff', 'DoctrineExtensions\Query\Mysql\TimestampDiff');
        //
        // $query->addSelect('timestampdiff()');

        return $query;
    }
}
