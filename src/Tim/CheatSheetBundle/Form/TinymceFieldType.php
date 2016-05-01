<?php

namespace Tim\CheatSheetBundle\Form;

use Symfony\Component\Form\AbstractType;

class TinymceFieldType extends AbstractType
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'textarea';
    }
}
