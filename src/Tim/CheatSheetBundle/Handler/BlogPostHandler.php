<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 4/13/2016
 * Time: 9:15 PM
 */

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Entity\BlogPostRepository;
use Tim\CheatSheetBundle\Interfaces\IRecordInterface;

class BlogPostHandler extends BaseHandler implements IRecordInterface
{
    /** @var  BlogPostRepository */
    protected $repository;

    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }

    public function findBy($options = array(), $orderBy = null, $maxRecords = null, $offset = null)
    {
        return $this->getRepository()->findBy($options, $orderBy, $maxRecords, $offset);
    }

    /**
     * @return BlogPostRepository
     */
    public function getRepository()
    {
        return parent::getRepository();
    }
}