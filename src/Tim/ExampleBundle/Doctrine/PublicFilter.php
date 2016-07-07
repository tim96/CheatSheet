<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/7/2016
 * Time: 8:45 PM
 */

namespace Tim\ExampleBundle\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;

class PublicFilter extends SQLFilter
{
    /**
     * Gets the SQL query part to add to a query.
     *
     * @param ClassMetaData $targetEntity
     * @param string $targetTableAlias
     *
     * @return string The constraint SQL if there is available, empty string otherwise.
     * @throws \InvalidArgumentException
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias)
    {
        if ($targetEntity->getReflectionClass()->name !== 'Tim\ExampleBundle\Entity\Category') {
            return '';
        }

        # This is error. You need to using database field name.
        #return sprintf('%s.isPublic = %s', $targetTableAlias, $this->getParameter('isPublic'));
        return sprintf('%s.is_public = %s', $targetTableAlias, $this->getParameter('isPublic'));
    }
}