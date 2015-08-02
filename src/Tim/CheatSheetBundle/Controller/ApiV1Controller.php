<?php

namespace Tim\CheatSheetBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;

class ApiV1Controller extends FOSRestController
{
    /**
     * @return array
     */
    public function indexAction()
    {
        return array('version' => 'v1');
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
}
