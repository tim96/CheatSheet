<?php

namespace Tim\ExampleBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tim\UtilsBundle\Utils\Performance;
use Doctrine\DBAL\Connection as DB;

class BoatSearchCommand extends ContainerAwareCommand
{
    // php app/console  -  show all commands

    /** @var  boolean */
    protected $isDebug;

    protected $countItems;

    protected function configure()
    {
        // run this command: php app/console tim:example:boat:search
        $this
            ->setName('tim:example:boat:search')
            ->setDescription('Search boat records')
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

        Performance::setMemoryLimit('512M');
        $output->writeln('Increase Memory limit: ' . Performance::getMemoryLimit());

        $memoryStart = Performance::getMemoryUsageFormatted();
        $timeStart = Performance::start();

        // $records = $this->variant1($em);
        // $records = $this->variant2($em);
        $records = $this->variant3($em);
        $output->writeln('Count records: ' . count($records));

        $timeEnd = Performance::current();
        $timeDiff = Performance::result($timeStart);
        $memoryEnd = Performance::getMemoryUsageFormatted();
        $memoryPeak = Performance::getPeakMemoryUsageFormatted();

        $output->writeln('Finish boat search');
        $output->writeln('Time start: ' . $timeStart);
        $output->writeln('Time end: ' . $timeEnd);
        $output->writeln('Diff: ' . $timeDiff);
        $output->writeln('Memory start: ' . $memoryStart);
        $output->writeln('Memory end: ' . $memoryEnd);
        $output->writeln('Memory max: ' . $memoryPeak);
    }

    /**
     * @param EntityManager $em
     *
     * @return array
     */
    protected function variant1($em)
    {
        $boatRepository = $em->getRepository('TimExampleBundle:BoatTest');

        $ids = $this->generateIds();

        $query = $boatRepository->getListByNumbers($ids)->getQuery();
        return $query->getArrayResult();
    }

    /**
     * @param EntityManager $em
     *
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function variant2($em)
    {
        $conn = $em->getConnection();

        $ids = $this->generateIds();

        return $conn->executeQuery('SELECT *
            FROM boat_test bt
            WHERE bt.number IN (:ids)
            ',
            array(':ids' => $ids),
            array(':ids' => DB::PARAM_INT_ARRAY)
        )
        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param EntityManager $em
     *
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function variant3($em)
    {
        $conn = $em->getConnection();

        $ids = $this->generateIds();

        $sql = 'SELECT *
            FROM boat_test bt
            WHERE bt.number IN (?)
            ';

        // $stmt = $conn->prepare($sql);
        // this stuff does not work:
        // The parameter list support only works with Doctrine\DBAL\Connection::executeQuery() and
        // Doctrine\DBAL\Connection::executeUpdate(), NOT with the binding methods of a prepared statement.
        //$stmt->bindValue(1, $ids, DB::PARAM_INT_ARRAY);
        // $stmt->execute();

        $stmt = $conn->executeQuery($sql,
            array($ids),
            array(DB::PARAM_INT_ARRAY));

        // return $stmt->fetchAssoc();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    protected function generateIds()
    {
        $ids = array();
        $count = 200;
        for($i = 1; $i < $count; $i++) {
            $ids[] = $i;
        }

        return $ids;
    }
}