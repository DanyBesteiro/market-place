<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Shared\Domain\Bus\Event\EventBus;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

final class DoctrineEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly EventBus $eventBus)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postUpdate
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->publishEntityEvents($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->publishEntityEvents($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->publishEntityEvents($args);
    }

    private function publishEntityEvents(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof AggregateRoot) {
            $this->eventBus->publish(...$entity->pullDomainEvents());
        }
    }
}