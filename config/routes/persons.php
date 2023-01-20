<?php

declare(strict_types=1);

use App\Controller\Person\AllPersonsGetController;
use App\Controller\Person\TrolleysByPersonGetController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_persons_get',
        path: '/'
    )
        ->methods(['GET'])
        ->controller(AllPersonsGetController::class);

    $routes->add(
        name: 'trolleys_by_person_get',
        path: '/{personId}/trolleys'
    )
        ->methods(['GET'])
        ->controller(TrolleysByPersonGetController::class);
};