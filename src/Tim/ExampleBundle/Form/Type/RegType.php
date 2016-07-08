<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/8/2016
 * Time: 9:00 PM
 */

namespace Tim\ExampleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // want to know your form type name? try this:
        // die($this->getBlockPrefix());

        $builder
            ->add('planet', null, array('label' => 'Planet'))
            ->add('country', null, array('label' => 'Country'))
            ->add('city', null, array('label' => 'City'))
            ->add('send', 'submit', array('label' => 'Send'))
        ;
    }
}