<?php

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Event\DomainEvent;

use \Symfony\Config\FrameworkConfig;
use \Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (FrameworkConfig $framework, ContainerConfigurator $container) {
    $messenger = $framework->messenger();
    $messenger->defaultBus('query.bus');

    $commandBus = $messenger->bus('command.bus');
    $queryBus = $messenger->bus('query.bus');
    $eventBus = $messenger->bus('event.bus');

    $eventBus->defaultMiddleware('allow_no_handlers');

    $messenger->transport('sync')->dsn('sync://');

    $messenger->routing(Command::class)->senders(['sync']);
    $messenger->routing(Query::class)->senders(['sync']);
    $messenger->routing(DomainEvent::class)->senders(['sync']);
};