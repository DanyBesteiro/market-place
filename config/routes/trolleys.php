<?php

declare(strict_types=1);

use App\Controller\Trolley\CreateTrolleyPostController;
use App\Controller\Trolley\FinalizeTrolleyPatchController;
use App\Controller\Trolley\AddArticleInATrolleyPostController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add(
        name: 'create_trolley_post',
        path: '/'
    )->methods(['POST'])
        ->controller(CreateTrolleyPostController::class);

    $routes->add(
        name: 'add_article_to_trolley_post',
        path: '/{trolleyId}/add_article'
    )->methods(['POST'])
        ->controller(AddArticleInATrolleyPostController::class);

    $routes->add(
        name: 'finalize_trolley_patch',
        path: '/{trolleyId}/finalize'
    )->methods(['PATCH'])
        ->controller(FinalizeTrolleyPatchController::class);
};