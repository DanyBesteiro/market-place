<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use \App\Controller\Films\AllFilmsGetController;
use \App\Controller\Films\FilmByCriteriaGetController;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_films_get',
        path: '/'
    )
        ->controller(AllFilmsGetController::class);

    $routes->add(
        name: 'film_by_criteria_get',
        path: '{criteria}/{value}'
    )
        ->controller(FilmByCriteriaGetController::class);
};