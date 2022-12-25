<?php

declare(strict_types=1);

use App\Controller\ParticipationTypes\AllParticipationTypesGetController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_participation_types_get',
        path: '/'
    )
        ->controller(AllParticipationTypesGetController::class);

};