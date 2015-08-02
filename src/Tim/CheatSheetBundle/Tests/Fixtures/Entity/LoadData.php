<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 02.08.2015
 * Time: 17:00
 */

namespace Tim\CheatSheetBundle\Tests\Fixtures\Entity;

use Tim\CheatSheetBundle\Entity\Feedback;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadData implements FixtureInterface
{
    static public $feedbacks = array();

    public function load(ObjectManager $manager)
    {
        $feedback = new Feedback();
        $feedback->setCreatedAt(new \DateTime());
        $feedback->setEmail("admin@admin.dev");
        $feedback->setIsAnswered(false);
        $feedback->setIsDeleted(false);
        $feedback->setMessage("Message body");
        $feedback->setName("Username");

        $manager->persist($feedback);
        $manager->flush();

        self::$feedbacks[] = $feedback;
    }
}