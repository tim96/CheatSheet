<?php

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Interfaces\IRecordInterface;
use Tim\CheatSheetBundle\Repository\SubscribeRepository;

class SubscribeHandler extends BaseHandler implements IRecordInterface
{
    /** @var  SubscribeRepository */
    protected $repository;

    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }

    public function add(array $parameters)
    {
        // todo: add logic to save new record
    }
}