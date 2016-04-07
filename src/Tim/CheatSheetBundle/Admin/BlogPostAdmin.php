<?php

namespace Tim\CheatSheetBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class BlogPostAdmin extends BaseAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('meta')
            ->add('text')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isPublish')
            // ->add('isDeleted')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->add('id')
            ->add('isPublish')
            ->add('tags')
            // ->add('meta')
            ->add('text')
            // ->add('description')
            ->add('createdAt')
            // ->add('updatedAt')

            // ->add('isDeleted')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->add('id')
            ->add('meta')
            ->add('tags')
            ->add('text')
            ->add('description')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('isPublish')
            // ->add('isDeleted')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('meta')
            ->add('tags')
            ->add('text')
            ->add('description')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isPublish')
            // ->add('isDeleted')
        ;
    }
}
