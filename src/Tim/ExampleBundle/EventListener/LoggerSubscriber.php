<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/26/2016
 * Time: 12:45 PM
 */

namespace Tim\ExampleBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Tim\CheatSheetBundle\Entity\Log;
use Tim\ExampleBundle\Entity\Orders;

class LoggerSubscriber implements EventSubscriber
{
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(Events::onFlush);
    }

    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if (!$entity instanceof Orders) { continue; }

            $log = new Log();
            $log->setMessage('Update records: ' . $entity->getId());
            $log->setData('Update records: ' . $entity->getId());
            $log->setLevel(200);
            $log->setCreatedAt(new \DateTime());

            $em->persist($log);
        }

        $uow->computeChangeSets();
    }
}