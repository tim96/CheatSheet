<?php

namespace Tim\CheatSheetBundle\Controller;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;
use Pagerfanta\Pagerfanta;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tim\CheatSheetBundle\Entity\BlogPost;
use Tim\CheatSheetBundle\Entity\DoctrinePost;
use Tim\CheatSheetBundle\Entity\Feedback;
use Tim\CheatSheetBundle\Entity\Subscribe;
use Tim\CheatSheetBundle\Form\FeedbackType;
use Tim\CheatSheetBundle\Form\SubscribeType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="Home")
     * @Template("TimCheatSheetBundle:Default:symfony2.html.twig")
     */
    public function indexAction(Request $request, $tab = 'controller')
    {
        $result = $this->container->get('tim_cheat_sheet.post.handler')
            ->getContent($tab);
        return $result;
    }

    /**
     * @Route("/about", name="About")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }

    /**
     * @Route("/blog/{page}", name="BlogPaging", requirements={
     *     "page": "\d+"
     * })
     * @throws \LogicException
     */
    public function blogPagingAction(Request $request, $page = 1)
    {
//        $paginator = $this->get('knp_paginator');
//        $maxRecords = 10;

        $blogPostService = $this->container->get('tim_cheat_sheet.blog.post.handler');
        $query = $blogPostService->getRepository()->getList()->getQuery();

        $adapter = new DoctrineORMAdapter($query);
        $pager =  new Pagerfanta($adapter);
        $pager->setCurrentPage($page);

        try  {
            $pager->setCurrentPage($page);
        }
        catch(NotValidCurrentPageException $e) {
            return $this->redirectToRoute('BlogPaging', array('page' => 1));
        }

//        $pagination = $paginator->paginate(
//            $query, /* query for get records */
//            $page, /* page number */
//            $maxRecords /* limit per page */
//        );

        $maxTagRecords = 15;
        $tagService = $this->container->get('tim_cheat_sheet.tag.handler');
        $tags = $tagService->getRepository()->findBy(
            array('isDeleted' => false), array('blogPostCount' => 'DESC'), $maxTagRecords);

        return $this->render('TimCheatSheetBundle:Default:blogPaging.html.twig',
            array(/*'pagination' => $pagination,*/'pager' => $pager, 'tags' => $tags));
    }

    /**
     * @Route("/blog/tag/{tagName}/{page}", name="BlogTagsPaging", requirements={
     *     "page": "\d+"
     * })
     * @Method({"GET"})
     *
     * @throws \LogicException
     */
    public function blogTagsPagingAction(Request $request, $tagName = null, $page = 1)
    {
        if (null === $tagName) {
            return $this->redirectToRoute('BlogPaging');
        }

        $paginator = $this->get('knp_paginator');
        $maxRecords = 10;

        $tagService = $this->container->get('tim_cheat_sheet.tag.handler');
        $tag = $tagService->getRepository()->findOneBy(array('isDeleted' => false, 'name' => $tagName));
        if (null === $tag) {
            return $this->redirectToRoute('BlogPaging');
        }

        $blogPostService = $this->container->get('tim_cheat_sheet.blog.post.handler');
        $query = $blogPostService->getRepository()->getListByTag($tag->getId())->getQuery();
        $pagination = $paginator->paginate(
            $query, /* query for get records */
            $page, /* page number */
            $maxRecords /* limit per page */
        );

        return $this->render('TimCheatSheetBundle:Default:blogPaging.html.twig',
            array('pagination' => $pagination, 'tags' => array($tag)));
    }

    /**
     * @Route("/blog/list", name="BlogList")
     * @Method({"GET"})
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function blogListAction(Request $request)
    {
        $blogPostService = $this->container->get('tim_cheat_sheet.blog.post.handler');
        $records = $blogPostService->getRepository()->getList()->getQuery()->getResult();

        $maxTagRecords = 15;
        $tagService = $this->container->get('tim_cheat_sheet.tag.handler');
        $tags = $tagService->getRepository()->findBy(
            array('isDeleted' => false), array('blogPostCount' => 'DESC'), $maxTagRecords);

        return $this->render('TimCheatSheetBundle:Default:blogList.html.twig',
            array('records' => $records, 'tags' => $tags));
    }

    /**
     * @Route("/blog/{name}", name="Blog")
     * @Method({"GET"})
     */
    public function blogAction(Request $request, $name = null)
    {
        $blogPostService = $this->container->get('tim_cheat_sheet.blog.post.handler');

        if (null === $name) {
            return $this->redirectToRoute('BlogPaging');
        }

        $record = $blogPostService->getRepository()->getOneByNameQuery($name)->getQuery()->getResult();
        if (count($record) < 1) {
            // if we can't find post by name, we show all last posts
            return $this->redirectToRoute('BlogPaging');
        }

        /** @var BlogPost $post */
        $post = $record[0];
        $post->setViewCount($post->getViewCount() + 1);

        $om = $this->getDoctrine()->getManager();
        $om->persist($post);
        $om->flush();

        return $this->render("TimCheatSheetBundle:Default:blogItem.html.twig", array('record' => $post));
    }

    // Example how to exclude some paths in routing
    // requirements={"tab" = "^(?!posts|login|register).+"}

    /**
     * @Route("/symfony2/{tab}", requirements={"tab" = "^(?!posts).+"}, name="Symfony2")
     * @Template()
     * @param Request $request
     * @param $tab
     * @return array
     */
    public function symfony2Action(Request $request, $tab = 'controller')
    {
        $result = $this->container->get('tim_cheat_sheet.post.handler')
            ->getContent($tab);
        return $result;
    }

    /**
     * @Route("/doctrine2/{slug}", name="Doctrine2")
     * @Method({"GET"})
     *
     * @param Request $request
     * @param null|string $slug
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function doctrine2Action(Request $request, $slug = null)
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('TimCheatSheetBundle:DoctrinePost');

        if (null !== $slug) {
            $records = $repository->getListBySlug($slug, $isPublic = true,
                $isDeleted = false, $maxRecords = 1)->getQuery()->getResult();

            if (count($records) > 0) {
                return $this->render("TimCheatSheetBundle:Default:doctrine2Item.html.twig",
                    array('doctrinePost' => $records[0]));
            }
        }

        $records = $repository->getList(null, $isPublic = true,
            $isDeleted = false, $maxRecords = DoctrinePost::ORDER_DEFAULT)->getQuery()->getResult();

        return $this->render("TimCheatSheetBundle:Default:doctrine2.html.twig", array('records' => $records));
    }

    /**
     * @Route("/sonataadmin", name="SonataAdmin")
     * @Template()
     */
    public function sonataAdminAction()
    {
        return array();
    }

    /**
     * @Route("/contact", name="Contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $feedback = new Feedback();
        $form = $this->createForm(new FeedbackType(), $feedback);

        $form->handleRequest($request);

        if ($form->isValid()) {

            try {
                $data = $form->getData();
                $record = $this->container->get('tim_cheat_sheet.feedback.handler')
                    ->create($data);

                $this->addFlash(
                    'notice',
                    'Thank you, for your feedback!'
                );
            }
            catch(\Exception $ex)
            {
                $this->addFlash('error', 'Sorry, something wrong');
                return array(
                    'form' => $form->createView()
                );
            }

            try
            {
                $mailer = $this->get('mailer');
                $email = $this->container->getParameter('email_sender');

                $this->container->get('tim_cheat_sheet.feedback.handler')
                    ->sendNotification($record, $mailer, $email);
            }
            catch(\Exception $ex)
            {
                // todo: add save exception
            }

            return $this->redirectToRoute('thankyou');
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/thankyou", name="thankyou")
     * @Template()
     */
    public function thankyouAction()
    {
        return array();
    }

    /**
     * @Route("/faq/{question}", name="Faq")
     *
     * @param null $question
     * @return array
     */
    public function faqAction($question = null)
    {
        // todo: move this code logic to handler
        if (null === $question) {
            $data = $this->container->get('tim_cheat_sheet.question.handler')
                ->getListAsArray();

            return $this->render("TimCheatSheetBundle:Default:faq.html.twig", array('questions' => $data));
        } else {
            $records = $this->container->get('tim_cheat_sheet.question.handler')
                ->getRepository()->getOneByQuestionQuery($question)->getQuery()->getResult();

            if (count($records) < 1) {
                // if we can't find item by question, we redirect to another page
                return $this->redirectToRoute('Faq');
            };

            return $this->render("TimCheatSheetBundle:Default:faqItem.html.twig", array('question' => $records[0]));
        }
    }

    public function mostViewedPostAction($max = 3)
    {
        $blogPostService = $this->container->get('tim_cheat_sheet.blog.post.handler');
        $records = $blogPostService->getRepository()->findBy(array('isDeleted' => false, 'isPublish' => true), array(
            'viewCount' => 'DESC'
        ), $max);

        return $this->render(
            '@TimCheatSheet/Default/popularPostsWidget.html.twig',
            array('records' => $records)
        );
    }

    /**
     * @Route("/subscribe", name="Subscribe")
     * @Method("POST")
     *
     * @Template()
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function subscribeAction(Request $request)
    {
        $data = $request->request->all();

        $subscribe = new Subscribe();
        $form = $this->createForm(new SubscribeType(), $subscribe, array('csrf_protection' => false));

        $form->submit($data);

        if ($form->isValid()) {

            try {
                $data = $form->getData();
                $record = $this->container->get('tim_cheat_sheet.subscribe.handler')
                    ->create($data);
            }
            catch(\Exception $ex)
            {
                // todo: add log error
                // die('Error: '.$ex->getMessage());
            }

            // todo: add email send with information

            $this->addFlash(
                'notice',
                'Thank you for subscribing to our newsletter!'
            );

            return $this->redirectToRoute('thankyou');
        }

        // todo: check this situation
        exit('Something wrong');
    }

    /**
     * @Route("/symfony2/posts/{name}", name="Symfony2Posts")
     * @Method({"GET"})
     *
     * @param Request $request
     * @param null|string $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
     * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
     */
    public function symfony2PostsAction(Request $request, $name = null)
    {
        $postService = $this->container->get('tim_cheat_sheet.post.handler');

        if (null !== $name) {
            $records = $postService->getListPosts($name)->getResult();

            if (count($records) > 0) {
                return $this->render("TimCheatSheetBundle:Default/symfony2:post.html.twig",
                    array('symfonyPost' => $records[0]));
            }
        }

        $records = $postService->getListPosts($name)->getResult();

        return $this->render("TimCheatSheetBundle:Default/symfony2:posts.html.twig", array('records' => $records));
    }
}
