<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use App\Shared\Infrastructure\Bus\Query\QueryNotRegisteredError;
use http\Exception\RuntimeException;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerDomainEventBus implements EventBus
{
    public function __construct(private readonly MessageBusInterface $eventBus)
    {
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event){
            $this->publisher($event);
        }
    }

    private function publisher(DomainEvent $event): void
    {
        try {
            $this->eventBus->dispatch($event);
        } catch (NoHandlerForMessageException){
            throw new RuntimeException('The event ' . get_class($event) . 'hasn\'t a event handler associated');
        } catch (HandlerFailedException $error) {
            throw $error->getPrevious() ?? $error;
        }
    }
}
