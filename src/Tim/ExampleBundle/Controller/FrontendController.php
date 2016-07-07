<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/4/2016
 * Time: 8:03 PM
 */

namespace Tim\ExampleBundle\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Method({"GET","POST"})
     * @Route("/collection", name="example_collection")
     * @Template("TimExampleBundle:Frontend:collection.html.twig")
     *
     * @param Request $request
     *
     * @return array
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function collectionAction(Request $request)
    {
        $data = array('values' => array('a', 'b', 'c'));
        $form = $this
            ->createFormBuilder($data)
            ->add('values', CollectionType::class,
                array(
                    'type' => 'text',
                    'label' => 'Add, move, remove values and press Submit.',
                    'options' => array(
                        'label' => 'Value',
                    ),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'required' => false,
                    'attr' => array(
                        'class' => 'my-selector',
                    ),
                ))
            ->add('submit', SubmitType::class)
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();
        }
        return array(
            'form' => $form->createView(),
            'data' => $data,
        );
    }

    /**
     * @Method({"GET"})
     * @Route("/filters", name="example_filters")
     * @Template("TimExampleBundle:Frontend:filters.html.twig")
     *
     * @param Request $request
     *
     * @return array
     * @throws \LogicException
     * @throws \InvalidArgumentException
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function filtersAction(Request $request)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        $filters = $em->getFilters()
            ->enable('category_public')
        ;
        $filters->setParameter('isPublic', true);

        $categoryRepository = $em->getRepository('TimExampleBundle:Category');
        $records = $categoryRepository->findAll();

        return array('records' => $records);
    }
}