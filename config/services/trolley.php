<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Shared\Infrastructure\EntryPoint\Controller\Controller;

return static function(ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(Controller::class)
        ->tag('controller.service_arguments');

    $services->load(
        'App\\Trolley\\Trolley\\',
        '../../src/Trolley/Trolley/*'
    );
};
