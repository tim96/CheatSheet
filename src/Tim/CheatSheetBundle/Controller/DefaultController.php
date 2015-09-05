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
     * @Template()
     */
    public function indexAction()
    {
        return $this->redirectToRoute('Symfony2');
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
     * @Route("/symfony2/{tab}", name="Symfony2")
     * @Template()
     * @param Request $request
     * @param $tab
     * @return array
     */
    public function symfony2Action(Request $request, $tab = 'controller')
    {
        $posts = $this->container->get('tim_cheat_sheet.post.handler')
            ->getListAsArray(false, true, true);
        $postTypes = array();
        $postSort = array();

        foreach($posts as $post) {
            if (!isset($postTypes[$post['postType']['id']])) {
                $postTypes[$post['postType']['id']] = array('name' => $post['postType']['name'],
                    'icon' => $post['postType']['iconName'],
                    'isActive' => strtoupper($tab) == strtoupper($post['postType']['name']));
            }
            $postSort[$post['postType']['id']][] = $post;
        }

        $result = array('tab' => $tab, 'posts' => $postSort, 'postTypes' => $postTypes);
        return $result;
    }

    /**
     * @Route("/doctrine2", name="Doctrine2")
     * @Template()
     */
    public function doctrine2Action()
    {
        return array();
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
