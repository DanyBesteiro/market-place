<?php

declare(strict_types=1);

use App\Controller\Place\AllPlacesGetController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_places_get',
        path: '/'
    )
        ->controller(AllPlacesGetController::class );

};