<?php

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Entity\TagRepository;
use Tim\CheatSheetBundle\Interfaces\IRecordInterface;

class TagHandler extends BaseHandler implements IRecordInterface
{
    /** @var  TagRepository */
    protected $repository;

    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }
}