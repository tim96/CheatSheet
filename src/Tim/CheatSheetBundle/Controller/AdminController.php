<?php

namespace Tim\CheatSheetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\File;
use Tim\CheatSheetBundle\Form\UploadSitemapType;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/uploadSitemap", name="UploadSitemap")
     * 
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new UploadSitemapType());

        $form->handleRequest($request);

        if ($form->isValid()) {

            $file = $form->get('sitemap')->getData();
            $filename = 'sitemap.xml';

            $dir = __DIR__.'/../../../../web';

            $file->move($dir, $filename) ;

            $this->addFlash('notice', 'File upload successfully');

            return $this->redirectToRoute('UploadSitemap');
        }

        return $this->render('TimCheatSheetBundle:Backend:uploadSitemap.html.twig',
            array('form' => $form->createView()));
    }
}