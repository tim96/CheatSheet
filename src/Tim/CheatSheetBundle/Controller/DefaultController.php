<?php

namespace Tim\CheatSheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="Home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
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
    public function contactAction()
    {
        // todo: Add contact form
        return array();
    }
}
