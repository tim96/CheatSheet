<?php

namespace Tim\CheatSheetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class UploadSitemapType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sitemap', 'file', array('label' => 'Please, upload sitemap.xml',
                'constraints' => array(
                    new File(
                        array(
                            'mimeTypes' => array('application/xml'),
                            'maxSize' => '10M'
                        )
                    )
                )))
            ->add('send', 'submit', array('label' => 'Upload'))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tim_cheatsheetbundle_upload_sitemap';
    }
}