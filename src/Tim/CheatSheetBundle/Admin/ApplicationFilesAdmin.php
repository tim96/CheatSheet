<?php

namespace Tim\CheatSheetBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ApplicationFilesAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('type')
            ->add('version')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('applicationFile')
            ->add('applicationPath')
            ->add('applicationSize')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->add('id')
            ->add('type')
            ->add('version')
//            ->add('applicationFile')
            ->add('applicationPath')
            ->add('applicationSize')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->add('id')
            ->add('type')
            ->add('version')
            ->add('application')
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('applicationFile', 'file', array(
                'required' => false, 'data_class' => null
            ));
//            ->add('applicationPath')
//            ->add('applicationSize')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('type')
            ->add('version')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('applicationFile')
            ->add('applicationPath')
            ->add('applicationSize')
        ;
    }
}
