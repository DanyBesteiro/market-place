<?php

declare(strict_types=1);

use App\Controller\Person\AllPersonsGetController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_persons_get',
        path: '/'
    )
        ->controller(AllPersonsGetController::class);

};