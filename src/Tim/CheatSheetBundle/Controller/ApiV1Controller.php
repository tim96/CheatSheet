<?php

namespace Tim\CheatSheetBundle\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\View;

class ApiV1Controller extends FOSRestController
{
    public function indexAction()
    {
        return array('version' => 'v1');
    }

    public function getFeedbackAction($id)
    {
        $feedback = $this->container
            ->get('tim_cheat_sheet.feedback.handler')
            ->get($id);

        return array('Feedback' => $feedback);
    }

    public function getFeedbacksAction()
    {
        $feedbacks = $this->container
            ->get('tim_cheat_sheet.feedback.handler')
            ->getList();

        return array('Feedbacks' => $feedbacks);
    }
}
