<?php

namespace Tim\CheatSheetBundle\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Tim\CheatSheetBundle\Entity\Feedback;
use Tim\CheatSheetBundle\Form\FeedbackType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="Home")
     * @Template("TimCheatSheetBundle:Default:symfony2.html.twig")
     */
    public function indexAction(Request $request, $tab = 'controller')
    {
        $result = $this->container->get('tim_cheat_sheet.post.handler')
            ->getContent($tab);
        return $result;
    }

    /**
     * @Route("/about", name="About")
     * @Template()
     */
    public function aboutAction()
    {
        return array();
    }

    /**
     * @Route("/blog", name="Blog")
     * @Template()
     */
    public function blogAction()
    {
        return array();
    }

    /**
     * @Route("/symfony2/{tab}", name="Symfony2")
     * @Template()
     * @param Request $request
     * @param $tab
     * @return array
     */
    public function symfony2Action(Request $request, $tab = 'controller')
    {
        $result = $this->container->get('tim_cheat_sheet.post.handler')
            ->getContent($tab);
        return $result;
    }

    /**
     * @Route("/doctrine2", name="Doctrine2")
     * @Template()
     */
    public function doctrine2Action()
    {
        $doctrine = $this->getDoctrine();
        $repository = $doctrine->getRepository('TimCheatSheetBundle:DoctrinePost');
        $records = $repository->findBy(array('isDeleted' => false), array('updatedAt' => 'DESC'), $maxRecords = 10);

        return array('records' => $records);
    }

    /**
     * @Route("/sonataadmin", name="SonataAdmin")
     * @Template()
     */
    public function sonataAdminAction()
    {
        return array();
    }

    /**
     * @Route("/contact", name="Contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $feedback = new Feedback();
        $form = $this->createForm(new FeedbackType(), $feedback);

        $form->handleRequest($request);

        if ($form->isValid()) {

            try {
                $data = $form->getData();
                $record = $this->container->get('tim_cheat_sheet.feedback.handler')
                    ->create($data);

                $this->addFlash(
                    'notice',
                    'Thank you, for your feedback!'
                );
            }
            catch(\Exception $ex)
            {
                $this->addFlash('error', 'Sorry, something wrong');
                return array(
                    'form' => $form->createView()
                );
            }

            try
            {
                $mailer = $this->get('mailer');
                $email = $this->container->getParameter('email_sender');

                $this->container->get('tim_cheat_sheet.feedback.handler')
                    ->sendNotification($record, $mailer, $email);
            }
            catch(\Exception $ex)
            {
                // todo: add save exception
            }

            return $this->redirectToRoute('thankyou');
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/thankyou", name="thankyou")
     * @Template()
     */
    public function thankyouAction()
    {
        return array();
    }

    /**
     * @Route("/faq", name="Faq")
     * @Template()
     */
    public function faqAction()
    {
        $data = $this->container->get('tim_cheat_sheet.question.handler')
            ->getListAsArray();

        return array('Questions' => $data);
    }
}
