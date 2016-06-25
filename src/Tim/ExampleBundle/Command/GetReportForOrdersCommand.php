<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/25/2016
 * Time: 8:14 PM
 */

namespace Tim\ExampleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetReportForOrdersCommand extends ContainerAwareCommand
{
    // php app/console  -  show all commands

    /** @var  boolean */
    protected $isDebug;

    protected function configure()
    {
        // run this command: php app/console tim:example:report:orders
        $this
            ->setName('tim:example:report:orders')
            ->setDescription('Create report for orders')
            ->addArgument('id', InputArgument::OPTIONAL, 'Order Id')
            ->addOption('isDebug',  null, InputOption::VALUE_NONE, 'If set, the task will exacute in debug mode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->isDebug = $input->getOption('isDebug');
        $container = $this->getContainer();

        $em = $container->get('doctrine.orm.default_entity_manager');
        $ordersRepository = $em->getRepository('TimExampleBundle:Orders');

        $id = $input->getArgument('id');

        $servicePdf = $container->get('tfox.mpdfport');
        $twig = $container->get('twig');

        $records = $ordersRepository->getByIds(array($id))->getQuery()->getResult();
        if (count($records) < 1) {
            return ;
        }

        $data = array('orders' => $records);
        $html = $twig->render('TimExampleBundle:Report:_report_example_table.html.twig', $data);
        $css = $twig->render('@TimExample/Report/_base_report_example_table.html.twig');

        $servicePdf->setAddDefaultConstructorArgs(false);
        $mpdf = $servicePdf->getMpdf(array('', 'A4', '', 7, 7, 7, 7));
        $mpdf->WriteHTML($css, 1);
        $mpdf->WriteHTML($html, 2);

        $filename = 'orders_report.pdf';
        // for controller action
        // $mpdf->Output($filename, 'I');
        // die();

        $mpdf->Output($filename, 'F');

        // $output->writeln('Finish execute command');
    }
}