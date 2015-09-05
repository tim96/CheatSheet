<?php
      
namespace Tim\CheatSheetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class LogAdmin extends BaseAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('level')
            ->add('levelName')
            ->add('message')
            ->add('data')
            ->add('userId')
            ->add('createdAt')
            // ->add('updatedAt')
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
            ->add('id')
            ->add('level')
            ->add('levelName')
            ->add('message')
            // ->add('data')
            // ->add('userId')
            ->add('createdAt')
            // ->add('updatedAt')
        ;
        parent::configureListFields($listMapper);
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('level')
            ->add('levelName')
            ->add('message')
            ->add('data')
            ->add('userId')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('level')
            ->add('levelName')
            ->add('message')
            ->add('data')
            ->add('userId')
            ->add('ipAddress')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->remove('create');
        $collection->remove('edit');
        $collection->remove('delete');
    }

    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id',
    );
}
