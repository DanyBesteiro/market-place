<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Infrastructure\Bus\Query\MessengerQueryBus;
use App\Shared\Infrastructure\EntryPoint\Controller\Controller;

return function(ContainerConfigurator $container) {

    $messenger_message_handler = 'messenger.message_handler';

    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(QueryHandler::class)
        ->tag($messenger_message_handler,['bus' => 'query.bus']);

    $services->instanceof(Controller::class)
        ->tag('controller.service_arguments');

    $services->load('App\\', '../src/')
        ->exclude('../src/{DependencyInjection,Entity,Tools,Kernel.php}');

    $services->load(
        'Api\\Shared\\Infrastructure\\Bus\\Query\\',
        '../src/Shared/Infrastructure/Bus/Query/MessengerQueryBus.php'
    )->args(['@messenger.event.bus']);

    $services->set(MessengerQueryBus::class);

    $services->alias(QueryBus::class, MessengerQueryBus::class);
};