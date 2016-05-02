<?php

namespace Tim\CheatSheetBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Tim\CheatSheetBundle\Entity\PostType;

class PostTypeAdmin extends BaseAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('priority')
            ->add('author')
            ->add('createdAt')
            ->add('updatedAt')
            // ->add('isDeleted')
        ;

        parent::configureDatagridFilters($datagridMapper);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        parent::configureListFields($listMapper);

        $listMapper
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->addIdentifier('id', null, array('route' => array('name' => 'show')))
            ->add('name')
            ->add('priority')
            ->add('author')
            ->add('createdAt')
            ->add('updatedAt')
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
            ->add('name')
            ->add('priority', 'choice', array(
                'choices' => PostType::getPriorityList()
            ))
            ->add('iconName')
            // ->add('createdAt')
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
            ->add('name')
            ->add('priority')
            ->add('iconName')
            ->add('createdAt')
            ->add('updatedAt')
            // ->add('isDeleted')
        ;
    }
}
