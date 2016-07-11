<?php

namespace Tim\ExampleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Product name', 'required' => true))
//            ->add('createdAt', 'datetime')
//            ->add('updatedAt', 'datetime')
            ->add('file', 'file', array('label' => 'Product description (PDF file)', 'required' => true))
            ->add('send', 'submit', array('label' => 'Create'))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tim\ExampleBundle\Entity\Product'
        ));
    }
}
