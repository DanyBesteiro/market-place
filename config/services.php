<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function(ContainerConfigurator $container) {
    $container->import('services/person.php');
    $container->import('services/trolley.php');
    $container->import('services/shared.php');
    $container->import('services/shipment.php');
    $container->import('services/article_in_trolley.php');
};