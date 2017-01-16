<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 1/16/2017
 * Time: 8:24 PM
 */

namespace Tim\ExampleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\LockHandler;

class LockCommand extends ContainerAwareCommand
{
    // php app/console  -  show all commands

    /** @var  boolean */
    protected $isDebug;

    protected $countItems;

    protected function configure()
    {
        // run this command: php app/console tim:example:lock
        $this
            ->setName('tim:example:lock')
            ->setDescription('Lock example')
            ->addOption('isDebug', null, InputOption::VALUE_NONE, 'If set, the task will exacute in debug mode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->isDebug = $input->getOption('isDebug');

        // $container = $this->getContainer();

        // create the lock
        $lock = new LockHandler('tim:example:lock');

        // wait for the lock release as long as necessary
        // if (!$lock->lock(true)) {

        if (!$lock->lock()) {
            $output->writeln('The command is already running in another process.');

            return 0;
        }

        // do some difficult task
        sleep(10000);
    }
}