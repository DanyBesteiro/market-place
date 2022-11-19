<?php

use App\Shared\Domain\Bus\Query\Query;
use \Symfony\Config\FrameworkConfig;
use \Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (FrameworkConfig $framework, ContainerConfigurator $container) {
    $messenger = $framework->messenger();
    $messenger->defaultBus('query.bus');

    $queryBus = $messenger->bus('query.bus');

    $messenger->transport('sync')->dsn('sync://');


    $messenger->routing(Query::class)->senders(['sync']);

};