<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Config\Doctrine\Orm\EntityManagerConfig;
use \Symfony\Config\DoctrineConfig;

return static function (DoctrineConfig $doctrine, ContainerConfigurator $container)
{
    $dbal = $doctrine->dbal();

    $dbal->defaultConnection('writer');

    $dbal->connection('writer')
        ->driver('pdo_mysql')
        ->serverVersion('5.7')
        ->url('mysql://daniel_user:daniel_password@127.0.0.1:8889/market_place?serverVersion=5.7')
        ->charset('UTF8');

    $orm = $doctrine->orm();
    $orm->autoGenerateProxyClasses(true)
        ->defaultEntityManager('writer');

    $writer = $orm->entityManager('writer');
    $writer->connection('writer');
    $writer->namingStrategy('doctrine.orm.naming_strategy.underscore_number_aware');
    adminExtracted($writer);
};

function adminExtracted( EntityManagerConfig $manager): void
{
    $boundedContexts = [
        'Person' => [
            //'ParticipationType',
            //'PeopleInFilm',
            'Person',
        ],
        'Trolley' => [
            'ArticleInTrolley',
            'Trolley',
            'Shipment',
        ],
    ];

    foreach ($boundedContexts as $contextName => $aggregates){
        foreach ($aggregates as $aggregate) {
            $manager->mapping($aggregate)
                ->isBundle(false)
                ->type('xml')
                ->dir('%kernel.project_dir%/src/'. $contextName.'/' . $aggregate . '/Infrastructure/Persistence/Doctrine')
                ->prefix('App\\' .$contextName.'\\'. $aggregate . '\Domain');
        }
    }
}
