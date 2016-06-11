<?php
      
namespace Tim\CheatSheetBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class PostAdmin extends BaseAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('text')
            ->add('isMain')
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
        $listMapper
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->addIdentifier('id', null, array('route' => array('name' => 'show')))
            ->add('text')
            ->add('description')
            ->add('tags')
            ->add('postType')
            ->add('isMain')
            ->add('createdAt')
            ->add('updatedAt')
            // ->add('isDeleted')
        ;
        parent::configureListFields($listMapper);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            // ->add('id')
            ->add('meta')
            ->add('text')
            ->add('description', CKEditorType::class)
            ->add('postType')
            ->add('tags', null, array('multiple' => true))
            ->add('isMain')
            // ->add('createdAt')
            // ->add('updatedAt')
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
            ->add('text')
            ->add('description')
            ->add('postType')
            ->add('isMain')
            ->add('tags')
            ->add('createdAt')
            ->add('updatedAt')
            // ->add('isDeleted')
        ;
    }
}
