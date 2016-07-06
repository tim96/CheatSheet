<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/6/2016
 * Time: 9:21 PM
 */

namespace Tim\ExampleBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Index', array('route' => 'example_index'));
        $menu->addChild('Collection', array('route' => 'example_collection'));

        $menu->setChildrenAttributes(array('class' => 'nav navbar-nav'));

        return $menu;
    }
}