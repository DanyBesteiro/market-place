<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

    $routes->import('routes/films.php')
        ->prefix('/film')
        ->namePrefix('film_');

    $routes->import('routes/persons.php')
        ->prefix('/person')
        ->namePrefix('person_');

    $routes->import('routes/participationTypes.php')
        ->prefix('/participation_type')
        ->namePrefix('participation_type_');

    $routes->import('routes/peopleInFilms.php')
        ->prefix('/people_in_film')
        ->namePrefix('people_in_film_');

    $routes->import('routes/places.php')
        ->prefix('/place')
        ->namePrefix('place_');

    $routes->import('routes/producers.php')
        ->prefix('/producer')
        ->namePrefix('producer_');
};