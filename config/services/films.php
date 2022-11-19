<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Shared\Infrastructure\EntryPoint\Controller\Controller;

return function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
    ;

    $services->load('App\\', '../../src/')
        ->exclude('../src/{DependencyInjection,Entity,Tools,Kernel.php}');

};