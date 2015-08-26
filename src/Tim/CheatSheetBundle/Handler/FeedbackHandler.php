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
     * @param $mailer \Swift_Mailer
     * @param $emailTo string
     * @return int
     */
    public function sendNotification($record, $mailer, $emailTo)
    {
        if (empty($emailTo)) return 0;

        // todo: add new email template
        $message = \Swift_Message::newInstance()
            ->setSubject('New feedback')
            ->setFrom("feeedback@example.com")
            ->setTo($emailTo)
            // ->setBody($this->renderView('TimCheatSheetBundle:Feedback:emailTemplateCreate.html.twig', array('param' => $param)))
            ->setBody("New feedback. id: {$record->getId()}; text: {$record->getMessage()}")
        ;

        // var_dump($result) // show errors
        return $mailer->send($message, $result);
    }
}