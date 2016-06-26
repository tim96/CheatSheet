<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/26/2016
 * Time: 12:33 PM
 */

namespace Tim\ExampleBundle\Interfaces;

interface CreatedAtEntityInterface
{
    /**
     * @param \DateTime $createdAt
     * @return mixed
     */
    public function setCreatedAt(\DateTime $createdAt);
}