<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/5/2016
 * Time: 8:59 PM
 */

namespace Tim\ExampleBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tim\ExampleBundle\Entity\Boat;
use Tim\UtilsBundle\Utils\Performance;
use Tim\UtilsBundle\Utils\Rand;

class BoatCreateCommand extends ContainerAwareCommand
{
    // php app/console  -  show all commands

    /** @var  boolean */
    protected $isDebug;

    protected $countItems;

    protected function configure()
    {
        // run this command: php app/console tim:example:boat:create
        $this
            ->setName('tim:example:boat:create')
            ->setDescription('Create boat records')
            ->addOption('isDebug', null, InputOption::VALUE_NONE, 'If set, the task will exacute in debug mode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->isDebug = $input->getOption('isDebug');
        $this->countItems = 10000;

        $container = $this->getContainer();
        /** @var EntityManager $em */
        $em = $container->get('doctrine.orm.default_entity_manager');

        $output->writeln('Start boat create');
        $output->writeln('Memory limit: ' . Performance::getMemoryLimit());

        $memoryStart = Performance::getMemoryUsageFormatted();
        $timeStart = Performance::start();

        // 1000 items - 26 seconds - 18mb
        // 10000 items - ~ seconds - ~ mb
        // $this->variant1($em);

        // 1000 items - 0.8 seconds - 19mb
        // 10000 items - 20 seconds - 81mb
        // $this->variant2($em);

        // 1000 items - 1.1 seconds - 15mb
        // 10000 items - 15 seconds - 38mb
        // $this->variant3($em);

        // 1000 items - 1 seconds - 19mb
        // 10000 items - 15 seconds - 81mb
        $this->variant4($em);

        $timeEnd = Performance::result($timeStart);
        $memoryEnd = Performance::getMemoryUsageFormatted();
        $memoryPeak = Performance::getPeakMemoryUsageFormatted();

        $output->writeln('Finish books update');
        $output->writeln('Time start: ' . $timeStart);
        $output->writeln('Diff: ' . $timeEnd);
        $output->writeln('Memory start: ' . $memoryStart);
        $output->writeln('Memory end: ' . $memoryEnd);
        $output->writeln('Memory max: ' . $memoryPeak);
    }

    /**
     * Simple create record
     */
    protected function variant1($em)
    {
        for($i = 0; $i < $this->countItems; $i++) {
            $record = new Boat();
            $record->setTitle(Rand::generate(25));
            $record->setDescription(Rand::generate(1000));

            $em->persist($record);
            $em->flush($record);
        }
        $em->clear();
    }

    protected function variant2($em)
    {
        for($i = 0; $i < $this->countItems; $i++) {
            $record = new Boat();
            $record->setTitle(Rand::generate(25));
            $record->setDescription(Rand::generate(1000));

            $em->persist($record);
        }

        $em->flush();
        $em->clear();
    }

    protected function variant3($em)
    {
        $batchSize = 30;

        for($i = 0; $i < $this->countItems; $i++) {
            $record = new Boat();
            $record->setTitle(Rand::generate(25));
            $record->setDescription(Rand::generate(1000));

            $em->persist($record);

            // flush everything to the database every 20 inserts
            if (($i % $batchSize) === 0) {
                $em->flush();
                $em->clear();
            }
        }

        $em->flush();
        $em->clear();
    }

    protected function variant4($em)
    {
        $em->getConnection()->beginTransaction();

        try {
            for ($i = 0; $i < $this->countItems; $i++) {
                $record = new Boat();
                $record->setTitle(Rand::generate(25));
                $record->setDescription(Rand::generate(1000));

                $em->persist($record);
            }

            $em->flush();
            $em->getConnection()->commit();
        }
        catch(\Exception $e)
        {
            $em->getConnection()->rollback();
        }

        $em->clear();
    }
}