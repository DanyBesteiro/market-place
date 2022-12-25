<?php

declare(strict_types=1);

namespace App\Command\DataLoaderCommandServices;

use App\Product\Producer\Application\Create\CreateProducerCommand;
use App\Product\Producer\Application\SearchByCriteria\SearchProducerByCriteriaQuery;
use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\ProducerName;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;

final class SaveProducerService
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus
    )
    {

    }

    public function saveProducer(string $producerName): string
    {
        $producer = $this->queryBus->ask(SearchProducerByCriteriaQuery::create('name',$producerName));

        if (!is_null($producer)){
            return $producer['id'];
        }

        $producerId = Uuid::random()->value();

        $this->commandBus->dispatch(
            CreateProducerCommand::create(
                new ProducerId($producerId),
                new ProducerName($producerName)
            )
        );

        return $producerId;
    }
}