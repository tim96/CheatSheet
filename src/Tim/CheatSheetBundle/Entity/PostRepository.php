<?php

namespace Tim\CheatSheetBundle\Entity;

/**
 * PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends \Doctrine\ORM\EntityRepository
{
    public function getPosts($isDeleted = false, $isJoinPostType = false, $isJoinTags = false)
    {
        $query = $this->getPostsQuery($isDeleted, $isJoinPostType, $isJoinTags);

        $data = $query->getQuery()->getResult();

        return $data ? $data : array();
    }

    public function getPostsAsArray($isDeleted = false, $isJoinPostType = false, $isJoinTags = false)
    {
        $query = $this->getPostsQuery($isDeleted, $isJoinPostType, $isJoinTags);

        $data = $query->getQuery()->getArrayResult();

        return $data ? $data : array();
    }

    private function getPostsQuery($isDeleted, $isJoinPostType, $isJoinTags)
    {
        $query = $this->createQueryBuilder('p');
        if (is_bool($isDeleted)) {
            $query->andWhere('p.isDeleted = :isDeleted')
                ->setParameter('isDeleted', $isDeleted)
            ;
        }

        if (is_bool($isJoinPostType) && $isJoinPostType) {
            $query->addSelect('pt')
                ->leftJoin('p.postType', 'pt')
            ;
        }

        if (is_bool($isJoinTags) && $isJoinTags) {
            $query->addSelect('t')
                ->leftJoin('p.tags', 't')
            ;
        }

        return $query;
    }

}
