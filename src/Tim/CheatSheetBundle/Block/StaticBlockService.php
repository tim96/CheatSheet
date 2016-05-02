<?php

namespace Tim\CheatSheetBundle\Block;

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

        /** @var BlogPostRepository $repBlogPost */
        $repBlogPost = $this->container->get('doctrine.orm.default_entity_manager')->getRepository('TimCheatSheetBundle:BlogPost');
        $query = $repBlogPost->getList();
        $countBlogPosts = $query->select('COUNT(' .$query->getRootAlias() . '.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;

        $result[] = array('text' => 'Blog Post', 'items' =>
            array(
                array('url' => $urlBlogPost, 'text' => 'List (' . $countBlogPosts . ')', 'icon' => '<i class="fa fa-list"></i>'),
                array('url' => $urlBlogPostCreate, 'text' => 'Add new', 'icon' => '<i class="fa fa-plus-circle"></i>')
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