<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->import('Films/routes.php')
        ->prefix('/film')
        ->namePrefix('film_');
};