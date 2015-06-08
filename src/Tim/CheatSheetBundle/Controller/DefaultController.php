<?php

namespace Tim\CheatSheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @Route("/symfony2", name="Symfony2")
     * @Template()
     */
    public function symfony2Action()
    {
        return array();
    }

    /**
     * @Route("/doctrine2", name="Doctrine2")
     * @Template()
     */
    public function doctrine2Action()
    {
        return array();
    }
}
