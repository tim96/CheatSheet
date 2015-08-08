<?php

namespace Tim\CheatSheetBundle\Controller\v2;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;

class ApiController extends FOSRestController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return array('version' => 'v2');
    }

    /**
     *
     * @Annotations\View(templateVar="Feedback")
     *
     * @param $id
     * @return array
     */
    public function getFeedbackAction($id)
    {
        $feedback = $this->container
            ->get('tim_cheat_sheet.feedback.handler')
            ->get($id);

        return $feedback;
    }

    /**
     *
     * @Annotations\View(templateVar="Feedbacks")
     *
     * @return array
     */
    public function getFeedbacksAction()
    {
        $feedbacks = $this->container
            ->get('tim_cheat_sheet.feedback.handler')
            ->getList();

        return array('Feedbacks' => $feedbacks);
    }

    /**
     *
     * @Annotations\View(templateVar="Question")
     *
     * @param $id
     * @return array
     */
    public function getQuestionAction($id)
    {
        $question = $this->container
            ->get('tim_cheat_sheet.question.handler')
            ->get($id);

        return $question;
    }

    /**
     *
     * @Annotations\View(templateVar="Questions")
     *
     * @return array
     */
    public function getQuestionsAction()
    {
        $questions = $this->container
            ->get('tim_cheat_sheet.question.handler')
            ->getList();

        return array('Questions' => $questions);
    }
}
