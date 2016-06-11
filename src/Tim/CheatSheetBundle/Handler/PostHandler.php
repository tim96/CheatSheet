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

    public function getListPosts($name, $isMain = false, $isDeleted = false, $maxResulst = null)
    {
        return $this->repository->getListPosts($name, $isMain, $isDeleted, $maxResulst);
    }

    public function getContent($tab)
    {
        $posts = $this->container->get('tim_cheat_sheet.post.handler')
            ->getListAsArray(false, true, true);
        $postTypes = array();
        $postSort = array();

        foreach($posts as $post) {
            if (!$this->checkAr($postTypes, $post['postType']['id'])) {
                $postTypes[] = array('name' => $post['postType']['name'],
                    'icon'     => $post['postType']['iconName'],
                    'isActive' => strtoupper($tab) == strtoupper($post['postType']['name']),
                    'priority' => $post['postType']['priority'],
                    'id'       => $post['postType']['id'],
                );
            }
            $postSort[$post['postType']['id']][] = $post;
        }

        usort($postTypes, function($a, $b) {
            return $b['priority'] - $a['priority'];
        });

        return array('tab' => $tab, 'posts' => $postSort, 'postTypes' => $postTypes);
    }

    private function checkAr($data, $value)
    {
        foreach($data as $item) {
            if ($item['id'] == $value) return true;
        }
        return false;
    }
}