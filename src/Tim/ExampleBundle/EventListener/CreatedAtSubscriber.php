<?php

namespace Tim\ExampleBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Tim\ExampleBundle\Interfaces\CreatedAtEntityInterface;

class CreatedAtSubscriber implements EventSubscriber
{
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array(Events::prePersist);
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof CreatedAtEntityInterface) {
            return;
        }

        $entity->setCreatedAt(new \DateTime());
    }
}
