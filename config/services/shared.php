<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Shared\Infrastructure\Bus\Command\MessengerCommandBus;
use App\Shared\Infrastructure\Bus\Query\MessengerQueryBus;
use App\Shared\Infrastructure\EntryPoint\Controller\Controller;

return static function(ContainerConfigurator $container) {

    $messenger_message_handler = 'messenger.message_handler';

    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(QueryHandler::class)
        ->tag($messenger_message_handler,['bus' => 'query.bus']);

    $services->instanceof(CommandHandler::class)
        ->tag($messenger_message_handler,['bus' => 'command.bus']);

    $services->instanceof(Controller::class)
        ->tag('controller.service_arguments');

    $services->load('App\\', '../../src/')
        ->exclude('../../src/{DependencyInjection,Entity,Tools,Kernel.php}');

    $services->load(
        'Api\\Shared\\Infrastructure\\Bus\\Query\\',
        '../../src/Shared/Infrastructure/Bus/Query/MessengerQueryBus.php'
    )->args(['@messenger.query.bus']);

    $services->load(
        'Api\\Shared\\Infrastructure\\Bus\\Command\\',
        '../../src/Shared/Infrastructure/Bus/Command/MessengerCommandBus.php'
    )->args(['@messenger.command.bus']);

    $services->set(MessengerQueryBus::class);
    $services->set(MessengerCommandBus::class);
};