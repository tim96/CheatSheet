<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 31.07.2015
 * Time: 23:21
 */

namespace Tim\CheatSheetBundle\Handler;

use Tim\CheatSheetBundle\Entity\Feedback;
use Tim\CheatSheetBundle\Interfaces\IRecordInterface;

class FeedbackHandler extends BaseHandler implements IRecordInterface
{
    public function get($id)
    {
        return $this->getRepository()->find($id);
    }

    public function getList($options = array())
    {
        return $this->getRepository()->findBy($options);
    }

    public function create($data)
    {
        $this->om->persist($data);
        $this->om->flush();
        return $data;
    }

    /**
     * @param $record Feedback
     * @param $mailer
     * @param $emailTo string
     */
    public function sendNotification($record, $mailer, $emailTo)
    {
        if (empty($emailTo)) return;

        // todo: add new email template
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
      //      ->setBody($this->renderView('TimCheatSheetBundle:Feedback:emailTemplateCreate.html.twig', array('param' => $param)))
            ->setBody("<body><h2>New feedback:</h2><p>id: {$record->getId()}<br/>text: {$record->getMessage()}</p></body>")
        ;

        $mailer->send($message);
    }
}