<?php

declare(strict_types=1);

use App\Controller\PeopleInFilms\AllPeopleInFilmsGetController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'all_people_in_films_get',
        path: '/'
    )
        ->controller( AllPeopleInFilmsGetController::class);

};