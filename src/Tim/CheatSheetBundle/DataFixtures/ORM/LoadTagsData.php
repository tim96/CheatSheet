<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/15/2016
 * Time: 8:56 PM
 */

namespace Tim\CheatSheetBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Tim\CheatSheetBundle\Entity\Tag;

class LoadTagsData extends AbstractFixture
{
    // run: php app/console doctrine:fixtures:load --append

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $repositoryTag = $manager->getRepository('TimCheatSheetBundle:Tag');

        $tags = array('symfony', 'php', 'doctrine');

        foreach ($tags as $tagName) {
            // Create new tags
            $tag = $this->createTag($tagName);

            $result = $this->saveTag($manager, $repositoryTag, $tag);
            $this->addLogMessage('Add tag - ' . $tagName . '; Result: ' . (string)$result);
        }
    }

    /**
     * @param $om ObjectManager
     * @param $repositoryTag EntityRepository
     * @param $tag Tag
     *
     * @return bool
     */
    protected function saveTag($om, $repositoryTag, $tag)
    {
        try
        {
            // Check tag before add it
            $result = $repositoryTag->findOneBy(array('name' => $tag->getName()));
            if (null === $result) {
                $om->persist($tag);
                $om->flush();

                return true;
            }

            return false;
        }
        catch (\Exception $ex)
        {
            // if exception was handle entity manager will be closed.
            die('Error add tag ' . $tag->getName() .'; Reason: ' . $ex->getMessage());
        }
    }

    protected function createTag($name)
    {
        $tag = new Tag();
        $tag->setCreatedAt(new \DateTime());
        $tag->setUpdatedAt(new \DateTime());
        $tag->setIsDeleted(false);
        $tag->setName($name);

        return $tag;
    }

    protected function addLogMessage($text)
    {
        echo $text.'<br/>\r\n';
    }
}