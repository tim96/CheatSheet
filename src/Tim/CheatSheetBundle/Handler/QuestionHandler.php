<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 31.07.2015
 * Time: 23:21
 */

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Entity\QuestionRepository;
use Tim\CheatSheetBundle\Interfaces\IRecordInterface;

class QuestionHandler extends BaseHandler implements IRecordInterface
{
    /** @var  QuestionRepository */
    protected $repository;

    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }

    public function getListAsArray()
    {
        return $this->getRepository()->getListAsArray();
    }

    public function getRepository()
    {
        return $this->repository;
    }
}