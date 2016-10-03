<?php

namespace Tim\ExampleBundle\Repository;

use Doctrine\DBAL\Connection as DB;

/**
 * BoatTestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BoatTestRepository extends \Doctrine\ORM\EntityRepository
{
    public function getListByNumbers($ids)
    {
        $qb = $this->createQueryBuilder('bt');

        $qb->andWhere('bt.number IN (:ids)')
            ->setParameter('ids', $ids, DB::PARAM_INT_ARRAY)
        ;

        return $qb;
    }

    public function getListByNumbersVariant2($ids)
    {
        $qb = $this->createQueryBuilder('bt');

        $qb->andWhere('bt.number IN (?1)')
            ->setParameter('1', $ids, DB::PARAM_INT_ARRAY)
        ;

        return $qb;
    }
}
