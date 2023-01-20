<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->import('routes/persons.php')
        ->prefix('/person')
        ->namePrefix('person_');

    $routes->import('routes/trolleys.php')
        ->prefix('/trolley')
        ->namePrefix('trolley_');
};