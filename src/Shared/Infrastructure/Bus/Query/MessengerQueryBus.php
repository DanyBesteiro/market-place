<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\Response;
use App\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

final class MessengerQueryBus implements QueryBus
{
    private readonly MessageBus $bus;

    public function __construct(private readonly MessageBusInterface $queryBus)
    {
    }

    public function ask(Query $query): mixed
    {
        try {
            /** @var HandledStamp $stamp */
            $envelope = $this->queryBus->dispatch($query);

            return $envelope->last(HandledStamp::class)?->getResult();
        } catch (NoHandlerForMessageException) {
            throw new QueryNotRegisteredError($query);
        }
    }
}
