<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/20/2016
 * Time: 9:06 PM
 */

namespace Tim\CheatSheetBundle\Command;

use Cocur\Slugify\Slugify;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Tim\CheatSheetBundle\Entity\DoctrinePost;

class SlugGenerateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('tcs:slug:generate')
            ->setDescription('Generate slug data for entities');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        $repDoctrinePost = $em->getRepository('TimCheatSheetBundle:DoctrinePost');

        // todo: 1. optimize this code using transactio and update function
        // todo: 2. create service for doctrine posts
        $records = $repDoctrinePost->getListBySlugEqualNull(null, null)->getQuery()->getResult();

        $countRecordsUpdate = 0;
        /** @var DoctrinePost $record */
        foreach ($records as $record) {
            $slugify = new Slugify();
            $record->setSlug($slugify->slugify($record->getText()));

            $em->persist($record);
            $em->flush();

            $countRecordsUpdate++;
        }

        $output->writeln('Count reords update: ' . $countRecordsUpdate);
        $output->writeln('Finish generate slug');
    }
}