<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use \App\Controller\Films\AllFilmsGetController;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_films_get',
        path: '/'
    )
        ->controller(AllFilmsGetController::class);
};