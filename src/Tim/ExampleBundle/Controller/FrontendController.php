<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/4/2016
 * Time: 8:03 PM
 */

namespace Tim\ExampleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Tim\ExampleBundle\Entity\Product;
use Tim\ExampleBundle\Form\Type\RegType;

class FrontendController extends BaseController
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
//        // Move this code to BeforeRequestListener
//        /** @var EntityManager $em */
//        $em = $this->getDoctrine()->getManager();
//        $filters = $em->getFilters()
//            ->enable('category_public')
//        ;
//        $filters->setParameter('isPublic', true);

        $em = $this->getDoctrine()->getManager();
        $categoryRepository = $em->getRepository('TimExampleBundle:Category');
        $records = $categoryRepository->findAll();

        return array('records' => $records);
    }

    /**
     * @Method({"GET","POST"})
     * @Route("/select", name="example_select")
     * @Template("TimExampleBundle:Frontend:select.html.twig")
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
    public function selectAction(Request $request)
    {
        $defaultData = array();
        $form = $this->createForm(new RegType(), $defaultData);

        $form->handleRequest($request);

        if ($form->isValid()) {

            // todo: add form processing
            die('Valid form');
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Method({"GET","POST"})
     * @Route("/newProduct", name="example_new_product")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     * @throws \LogicException
     * @throws \InvalidArgumentException
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function newProductAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('Tim\ExampleBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($product);
                $em->flush();

                $this->success('Product was created successfully');

                return $this->redirect($this->generateUrl('example_list_product'));
            }
            catch (\Exception $ex)
            {
                $this->danger('Error create product');
            }
        }

        return $this->render('TimExampleBundle:Frontend:newProduct.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Method({"GET"})
     * @Route("/listProduct", name="example_list_product")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     * @throws \Symfony\Component\HttpFoundation\File\Exception\FileException
     * @throws \LogicException
     * @throws \InvalidArgumentException
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function listProductAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $productsRepository = $em->getRepository('TimExampleBundle:Product');
        $products = $productsRepository->findBy(array(), null, 20);

        return $this->render('TimExampleBundle:Frontend:listProduct.html.twig', array(
            'products' => $products
        ));
    }
}