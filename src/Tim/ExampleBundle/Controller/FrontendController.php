<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/4/2016
 * Time: 8:03 PM
 */

namespace Tim\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class FrontendController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/", name="example_index")
     * @Template("TimExampleBundle:Frontend:index.html.twig")
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function indexAction(Request $request)
    {
        $bookService = $this->container->get('tim_example.book.service');
        $books = $bookService->getListQuery($limit = 25)->getQuery()->getResult();

        return array('books' => $books);
    }
}