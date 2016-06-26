<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/26/2016
 * Time: 12:59 PM
 */

namespace Tim\ExampleBundle\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tim\ExampleBundle\Entity\Book;
use Tim\ExampleBundle\Repository\BookRepository;
use Tim\UtilsBundle\Utils\Performance;

class BooksUpdateCommand extends ContainerAwareCommand
{
    // php app/console  -  show all commands

    /** @var  boolean */
    protected $isDebug;

    protected function configure()
    {
        // run this command: php app/console tim:example:books:update
        $this
            ->setName('tim:example:books:update')
            ->setDescription('Update books records')
            ->addOption('isDebug', null, InputOption::VALUE_NONE, 'If set, the task will exacute in debug mode');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->isDebug = $input->getOption('isDebug');
        $container = $this->getContainer();
        $em = $container->get('doctrine.orm.default_entity_manager');
        $booksRepository = $em->getRepository('TimExampleBundle:Book');

        $output->writeln('Start books update');
        $output->writeln('Memory limit: ' . Performance::getMemoryLimit());

        $memoryStart = Performance::getMemoryUsageFormatted();
        $timeStart = Performance::start();

        // Variant 1.
        // $this->variant1($em, $booksRepository);
        // Variant 2.
        // $this->variant2($em, $booksRepository);
        // Variant 3.
        // $this->variant3($em, $booksRepository);
        // Variant 4.
        // $this->variant4($em, $booksRepository);
        // Variant 5.
        // $this->variant5($em, $booksRepository);
        // Variant 6.
        // $this->variant6($em, $booksRepository);
        // Variant 7.
        // $this->variant7($em, $booksRepository);
        // Variant 7.1.
        // $this->variant7_1($em, $booksRepository);
        // Variant 7_2.
        // $this->variant7_2($em, $booksRepository);
        // Variant 8.
        // $this->variant8($em, $booksRepository);

        $timeEnd = Performance::result($timeStart);
        $memoryEnd = Performance::getMemoryUsageFormatted();
        $memoryPeak = Performance::getPeakMemoryUsageFormatted();

//        unset($records);
//        $memoryEndAfterUnset = Performance::getMemoryUsageFormatted();

        $output->writeln('Finish books update');
        $output->writeln('Time start: ' . $timeStart);
        $output->writeln('Diff: ' . $timeEnd);
        $output->writeln('Memory start: ' . $memoryStart);
        $output->writeln('Memory end: ' . $memoryEnd);
        $output->writeln('Memory max: ' . $memoryPeak);
//        $output->writeln('Memory end after unset: ' . $memoryEndAfterUnset);
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant1($em, $bookRepository)
    {
        $records = $bookRepository->getList()->getQuery()->getResult();

        /** @var Book $record */
        foreach ($records as $record) {
            $record->setPriceTax($record->getPrice() + $this->getTaxForBook($record->getId()));
            $record->setUpdatedAt(new \DateTime());
        }

        $em->flush();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant2($em, $bookRepository)
    {
        $i = 0;
        $batchSize = 20;

        $records = $bookRepository->getList()->getQuery()->getResult();

        /** @var Book $record */
        foreach ($records as $record) {
            $record->setPriceTax($record->getPrice() + $this->getTaxForBook($record->getId()));
            $record->setUpdatedAt(new \DateTime());

            if (($i % $batchSize) === 0) {
                $em->flush();
            }

            ++$i;
        }

        $em->flush();
        $em->clear();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant3($em, $bookRepository)
    {
        $i = 0;
        $batchSize = 20;

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getList()->getQuery()->getResult();

        /** @var Book $record */
        foreach ($records as $record) {
            $record->setPriceTax($record->getPrice() + $this->getTaxForBook($record->getId()));
            $record->setUpdatedAt(new \DateTime());

            if (($i % $batchSize) === 0) {
                $em->flush();
            }

            ++$i;
        }

        $em->flush();
        $em->clear();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant4($em, $bookRepository)
    {
        $i = 0;
        $batchSize = 1000;

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getList()->getQuery()->getResult();

        /** @var Book $record */
        foreach ($records as $record) {
            $record->setPriceTax($record->getPrice() + $this->getTaxForBook($record->getId()));
            $record->setUpdatedAt(new \DateTime());

            if (($i % $batchSize) === 0) {
                $em->flush();
            }

            ++$i;
        }

        $em->flush();
        $em->clear();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant5($em, $bookRepository)
    {
        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getList()->getQuery();

        /** @var Book[] $record */
        foreach ($records->iterate() as $record) {
            $record[0]->setPriceTax($record[0]->getPrice() + $this->getTaxForBook($record[0]->getId()));
            $record[0]->setUpdatedAt(new \DateTime());

            $em->flush($record[0]);
            $em->detach($record[0]);
        }
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant6($em, $bookRepository)
    {
        $connection = $em->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getList()->getQuery();

        $connection->beginTransaction();

        /** @var Book[] $record */
        foreach ($records->iterate() as $record) {
            $record[0]->setPriceTax($record[0]->getPrice() + $this->getTaxForBook($record[0]->getId()));
            $record[0]->setUpdatedAt(new \DateTime());

            $em->flush($record[0]);
            $em->detach($record[0]);
        }

        $connection->commit();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant7($em, $bookRepository)
    {
        $connection = $em->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getList()->getQuery();

        $connection->beginTransaction();

        $tableName = $em->getClassMetadata('TimExampleBundle:Book')->getTableName();
        $date = new \DateTime();

        /** @var Book[] $record */
        foreach ($records->iterate() as $record) {

            $connection->update(
                $tableName,
                array(
                    'price_tax' => $record[0]->getPrice() + $this->getTaxForBook($record[0]->getId()),
                    'updated_at' => $date->format('Y-m-d H:i:s'),
                ),
                array('id' => $record[0]->getId())
            );

            $em->detach($record[0]);
        }

        $connection->commit();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant7_1($em, $bookRepository)
    {
        $connection = $em->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);

        $records = $bookRepository->getListPartialForExample()->getQuery();

        $connection->beginTransaction();

        $tableName = $em->getClassMetadata('TimExampleBundle:Book')->getTableName();
        $date = new \DateTime();

        /** @var Book[] $record */
        foreach ($records->iterate() as $record) {

            $connection->update(
                $tableName,
                array(
                    'price_tax' => $record[0]->getPrice() + $this->getTaxForBook($record[0]->getId()),
                    'updated_at' => $date->format('Y-m-d H:i:s'),
                ),
                array('id' => $record[0]->getId())
            );

            $em->detach($record[0]);
        }

        $connection->commit();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant7_2($em, $bookRepository)
    {
        $connection = $em->getConnection();
        $connection->getConfiguration()->setSQLLogger(null);

        // try to change Result to arrayResult
        $records = $bookRepository->getList()->getQuery();

        $connection->beginTransaction();

        $tableName = $em->getClassMetadata('TimExampleBundle:Book')->getTableName();
        $date = new \DateTime();

        /** @var mixed $record */
        foreach ($records->iterate(null, Query::HYDRATE_ARRAY) as $record) {

            $connection->update(
                $tableName,
                array(
                    'price_tax' => $record[0]['price'] + $this->getTaxForBook($record[0]['id']),
                    'updated_at' => $date->format('Y-m-d H:i:s'),
                ),
                array('id' => $record[0]['id'])
            );
        }

        $connection->commit();
    }

    /**
     * @param EntityManager $em
     * @param BookRepository $bookRepository
     */
    private function variant8($em, $bookRepository)
    {
        $em->createQueryBuilder()
            ->update('TimExampleBundle:Book', 'b')
            ->set('b.priceTax', 'p.priceTax + 50')
            ->getQuery()
            ->execute();
    }

    protected function getTaxForBook($bookId)
    {
        // this value was dynamically change from tax table
        return 50;
    }


}