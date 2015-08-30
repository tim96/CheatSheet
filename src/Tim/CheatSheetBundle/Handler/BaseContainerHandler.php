<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/30/2015
 * Time: 4:07 PM
 */

namespace Tim\CheatSheetBundle\Handler;

use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class BaseContainerHandler
{
    /** @var  ContainerInterface */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

}