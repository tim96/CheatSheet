<?php

namespace Tim\CheatSheetBundle\Admin;

// use Sonata\AdminBundle\Admin\Admin;
use Cocur\Slugify\Slugify;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Tim\CheatSheetBundle\Entity\DoctrinePost;
use Tim\CheatSheetBundle\Form\TinymceFieldType;

class DoctrinePostAdmin extends BaseAdmin
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
            ->add('orderPosition')
            ->add('isPublic')
            ->add('description')
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
            ->add('meta')
            ->add('text')
            ->add('orderPosition')
            ->add('isPublic')
            // ->add('description')
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
            ->add('meta')
            ->add('text')
            ->add('description', new TinymceFieldType(), array(
                'attr' => array('rows' => '15', 'class' => 'tinymce'))
            )
            ->add('orderPosition')
            ->add('isPublic')
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
            ->add('orderPosition')
            ->add('isPublic')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('isDeleted')
        ;
    }

    public function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);

        $collection->add('createPDF', $this->getRouterIdParameter().'/createPDF');
    }

    /**
     * @param DoctrinePost $object
     */
    public function prePersist($object)
    {
        parent::prePersist($object);

        $this->addSlugify($object);
    }

    /**
     * @param DoctrinePost $object
     */
    public function preUpdate($object)
    {
        parent::preUpdate($object);

        $this->addSlugify($object);
    }

    /**
     * @param DoctrinePost $object
     *
     * @return DoctrinePost
     */
    protected function addSlugify($object)
    {
        $slugify = new Slugify();
        $object->setSlug($slugify->slugify($object->getText()));

        return $object;
    }
}
