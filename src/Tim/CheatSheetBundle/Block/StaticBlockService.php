<?php

namespace Tim\CheatSheetBundle\Block;

use Application\Sonata\UserBundle\Entity\UserRepository;
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
use Tim\CheatSheetBundle\Entity\PostRepository;
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

        $urlPost = $router->generate('admin_tim_cheatsheet_post_list');
        $urlPostCreate = $router->generate('admin_tim_cheatsheet_post_create');

        $urlUser = $router->generate('admin_sonata_user_user_list');
        $urlUserCreate = $router->generate('admin_sonata_user_user_create');

        $em = $this->container->get('doctrine.orm.default_entity_manager');

        /** @var BlogPostRepository $repBlogPost */
        $repBlogPost = $em->getRepository('TimCheatSheetBundle:BlogPost');
        $countBlogPosts = $this->calculateRecords($repBlogPost->getList());

        /** @var DoctrinePostRepository $repDoctrinePost */
        $repDoctrinePost = $em->getRepository('TimCheatSheetBundle:DoctrinePost');
        $countDoctrinePosts = $this->calculateRecords($repDoctrinePost->getList());

        /** @var FeedbackRepository $repFeedback */
        $repFeedback = $em->getRepository('TimCheatSheetBundle:Feedback');
        $countFeedbacks = $this->calculateRecords($repFeedback->getList());

        /** @var QuestionRepository $repQuestion */
        $repQuestion = $em->getRepository('TimCheatSheetBundle:Question');
        $countQuestions = $this->calculateRecords($repQuestion->getList());

        /** @var PostRepository $repPost */
        $repPost = $em->getRepository('TimCheatSheetBundle:Post');
        $countPosts = $this->calculateRecords($repPost->getList());

        /** @var UserRepository $repUser */
        $repUser = $em->getRepository('ApplicationSonataUserBundle:User');
        $countUsers = $this->calculateRecords($repUser->getList());

        $result[] = $this->prepareMenuItem('Blog Post', $urlBlogPost, $countBlogPosts, $urlBlogPostCreate);
        $result[] = $this->prepareMenuItem('Doctrine Post', $urlDoctrinePost, $countDoctrinePosts, $urlDoctrinePostCreate);
        $result[] = $this->prepareMenuItem('Feedback', $urlFeedbackList, $countFeedbacks);
        $result[] = $this->prepareMenuItem('Question', $urlQuestion, $countQuestions, $urlQuestionCreate);
        $result[] = $this->prepareMenuItem('Symfony Post', $urlPost, $countPosts, $urlPostCreate);
        $result[] = $this->prepareMenuItem('User', $urlUser, $countUsers, $urlUserCreate);

        return $this->renderResponse('TimCheatSheetBundle:Backend:static_block.html.twig', array(
            'block'     => $block,
            'settings'  => $settings,
            'result'    => $result,
            'label'     => $label
        ), $response);
    }

    private function calculateRecords($query)
    {
        try {
            return $query->select('COUNT(' .$query->getRootAlias() . '.id)')
                ->getQuery()
                ->getSingleScalarResult();
        }
        catch(NoResultException $e)
        {
            return 0;
        }
    }

    private function prepareMenuItem($label, $urlFirst, $count, $urlSecond = null)
    {
        $items = array();
        $items[] = array('url' => $urlFirst, 'text' => 'List (' . $count . ')', 'icon' => '<i class="fa fa-list"></i>');
        if (null !== $urlSecond) {
            $items[] = array('url' => $urlSecond, 'text' => 'Add new', 'icon' => '<i class="fa fa-plus-circle"></i>');
        }

        return array('text' => $label, 'items' => $items);
    }
}