<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/13/2016
 * Time: 9:03 PM
 */

namespace Tim\ExampleBundle\Command;

use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class DoctrineCrudCommand extends GenerateDoctrineCrudCommand
{
    protected function configure()
    {
        parent::configure();

        $this->setName('doctrine:generate:crud');
    }

    protected function getGenerator(BundleInterface $bundle = null)
    {
        $generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/crud');
        $this->setGenerator($generator);
        return parent::getGenerator();
    }
}