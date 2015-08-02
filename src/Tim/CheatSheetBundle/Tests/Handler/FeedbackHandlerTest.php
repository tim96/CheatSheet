<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 02.08.2015
 * Time: 16:40
 */

namespace Tim\CheatSheetBundle\Tests\Handler;

use Tim\CheatSheetBundle\Entity\Feedback;
use Tim\CheatSheetBundle\Handler\FeedbackHandler;

class FeedbackHandlerTest extends \PHPUnit_Framework_TestCase
{
    const FEEDBACK_CLASS = 'Tim\CheatSheetBundle\Tests\Handler\FeedbackMock';
    /** @var FeedbackHandler */
    protected $feedbackHandler;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $om;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $repository;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $container;

    public function setUp()
    {
        if (!interface_exists('Doctrine\Common\Persistence\ObjectManager')) {
            $this->markTestSkipped('Doctrine Common has to be installed for this test to run.');
        }

        $class = $this->getMock('Doctrine\Common\Persistence\Mapping\ClassMetadata');
        $this->om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');
        // $this->formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        $this->container = $this->getMock('Symfony\Component\DependencyInjection\ContainerInterface');
        $this->om->expects($this->any())
            ->method('getRepository')
            ->with($this->equalTo(static::FEEDBACK_CLASS))
            ->will($this->returnValue($this->repository));
        $this->om->expects($this->any())
            ->method('getClassMetadata')
            ->with($this->equalTo(static::FEEDBACK_CLASS))
            ->will($this->returnValue($class));
        $class->expects($this->any())
            ->method('getEmail')
            ->will($this->returnValue(static::FEEDBACK_CLASS));
    }

    protected function createFeedbackHandler($container, $objectManager, $class)
    {
        return new FeedbackHandler($container, $objectManager, $class);
    }

    protected function getFeedback()
    {
        $feedbackClass = static::FEEDBACK_CLASS;
        return new $feedbackClass();
    }

    public function testGet()
    {
        $id = 1;
        $feedback = $this->getFeedback();
        $this->repository->expects($this->once())->method('find')
            ->with($this->equalTo($id))
            ->will($this->returnValue($feedback));
        $this->feedbackHandler = $this->createFeedbackHandler($this->container, $this->om, static::FEEDBACK_CLASS);
        $this->feedbackHandler->get($id);
    }
}

class FeedbackMock extends Feedback
{

}