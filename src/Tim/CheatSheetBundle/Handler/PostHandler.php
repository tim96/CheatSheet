<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 9/5/2015
 * Time: 5:32 PM
 */

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Entity\PostRepository;
use Tim\CheatSheetBundle\Interfaces\IRecordInterface;

class PostHandler extends BaseHandler implements IRecordInterface
{
    /** @var  PostRepository */
    protected $repository;

    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }

    public function getListAsArray($deleted = false, $isJoinPostType = false, $isJoinTags = false)
    {
        return $this->repository->getPostsAsArray($deleted, $isJoinPostType, $isJoinTags);
    }
}