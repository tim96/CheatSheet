<?php

namespace Tim\CheatSheetBundle\Block;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Validator\ErrorElement;
use Sonata\BlockBundle\Block\BaseBlockService;
use Tim\CheatSheetBundle\Entity\BlogPostRepository;
use Tim\CheatSheetBundle\Entity\DoctrinePostRepository;
use Tim\CheatSheetBundle\Entity\FeedbackRepository;
use Tim\CheatSheetBundle\Entity\QuestionRepository;

class StaticBlockService extends BaseBlockService
{
    /** @var  ContainerInterface */
    protected $container;

    public function __construct($name, EngineInterface $templating, $container)
    {
        parent::__construct($name, $templating);

        $this->container = $container;
    }

    public function getDefaultSettings()
    {
        return array();
    }
    
    public function execute(BlockContextInterface $block, Response $response = null)
    {
        // merge settings
        $settings = array_merge($this->getDefaultSettings(), $block->getSettings());

        $result = array();

        $label = 'Statistics';

        $router = $this->container->get('router');
        $urlBlogPost = $router->generate('admin_tim_cheatsheet_blogpost_list');
        $urlBlogPostCreate = $router->generate('admin_tim_cheatsheet_blogpost_create');

        $urlDoctrinePost = $router->generate('admin_tim_cheatsheet_doctrinepost_list');
        $urlDoctrinePostCreate = $router->generate('admin_tim_cheatsheet_doctrinepost_create');

        $urlFeedbackList = $router->generate('admin_tim_cheatsheet_feedback_list');

        $urlQuestion = $router->generate('admin_tim_cheatsheet_question_list');
        $urlQuestionCreate = $router->generate('admin_tim_cheatsheet_question_create');

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        /** @var BlogPostRepository $repBlogPost */
        $repBlogPost = $em->getRepository('TimCheatSheetBundle:BlogPost');
        $query = $repBlogPost->getList();

        try {
            $countBlogPosts = $query->select('COUNT(' . $query->getRootAlias() . '.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NoResultException $e)
        {
            $countBlogPosts = 0;
        }

        /** @var DoctrinePostRepository $repDoctrinePost */
        $repDoctrinePost = $em->getRepository('TimCheatSheetBundle:DoctrinePost');
        $queryDoctrinePost = $repDoctrinePost->getList();

        try {
            $countDoctrinePosts = $queryDoctrinePost->select('COUNT(' . $queryDoctrinePost->getRootAlias() . '.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NoResultException $e)
        {
            $countDoctrinePosts = 0;
        }

        /** @var FeedbackRepository $repFeedback */
        $repFeedback = $em->getRepository('TimCheatSheetBundle:Feedback');
        $queryFeedbacks = $repFeedback->getList();

        try {
            $countFeedbacks = $queryFeedbacks->select('COUNT(' .$queryFeedbacks->getRootAlias() . '.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NoResultException $e)
        {
            $countFeedbacks = 0;
        }

        /** @var QuestionRepository $repQuestion */
        $repQuestion = $em->getRepository('TimCheatSheetBundle:Question');
        $queryQuestions = $repQuestion->getList();

        try {
            $countQuestions = $queryQuestions->select('COUNT(' .$queryQuestions->getRootAlias() . '.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NoResultException $e)
        {
            $countQuestions = 0;
        }

        $result[] = array('text' => 'Blog Post', 'items' =>
            array(
                array('url' => $urlBlogPost, 'text' => 'List (' . $countBlogPosts . ')', 'icon' => '<i class="fa fa-list"></i>'),
                array('url' => $urlBlogPostCreate, 'text' => 'Add new', 'icon' => '<i class="fa fa-plus-circle"></i>')
            )
        );

        $result[] = array('text' => 'Doctrine Post', 'items' =>
            array(
                array('url' => $urlDoctrinePost, 'text' => 'List (' . $countDoctrinePosts . ')', 'icon' => '<i class="fa fa-list"></i>'),
                array('url' => $urlDoctrinePostCreate, 'text' => 'Add new', 'icon' => '<i class="fa fa-plus-circle"></i>')
            )
        );

        $result[] = array('text' => 'Feedback', 'items' =>
            array(
                array('url' => $urlFeedbackList, 'text' => 'List (' . $countFeedbacks . ')', 'icon' => '<i class="fa fa-list"></i>'),
            )
        );

        $result[] = array('text' => 'Question', 'items' =>
            array(
                array('url' => $urlQuestion, 'text' => 'List (' . $countQuestions . ')', 'icon' => '<i class="fa fa-list"></i>'),
                array('url' => $urlQuestionCreate, 'text' => 'Add new', 'icon' => '<i class="fa fa-plus-circle"></i>')
            )
        );

        return $this->renderResponse('TimCheatSheetBundle:Backend:static_block.html.twig', array(
            'block'     => $block,
            'settings'  => $settings,
            'result'    => $result,
            'label'     => $label
        ), $response);
    }
}