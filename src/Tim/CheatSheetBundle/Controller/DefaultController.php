<?php

namespace Tim\CheatSheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
        $qet = $request->query->all(); // to get all GET params
        $post = $request->request->all(); // to get all POST params.
        $cookies = $request->cookies->all(); // to get all cookies params.
        $files = $request->files->all(); // to get all files params.

        return array('tab' => $tab);
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

            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash(
                'notice',
                'Thank you, for your feedback!'
            );

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
