<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use \App\Controller\Producer\AllProducersGetController;
use \App\Controller\Films\FilmByCriteriaGetController;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_producers_get',
        path: '/'
    )
        ->controller(AllProducersGetController::class);

    $routes->add(
        name: 'film_by_criteria_get',
        path: '{criteria}/{value}'
    )
        ->controller(FilmByCriteriaGetController::class);
};