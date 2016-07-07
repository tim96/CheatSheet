<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/7/2016
 * Time: 9:11 PM
 */

namespace Tim\ExampleBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class BeforeRequestListener
{
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $filters = $this->em->getFilters()
            ->enable('category_public')
        ;
        $filters->setParameter('isPublic', true);
        // $filters->setParameter('isPublic', false);
    }
}