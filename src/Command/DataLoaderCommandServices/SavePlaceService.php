<?php

declare(strict_types=1);

namespace App\Command\DataLoaderCommandServices;

use App\Product\Place\Application\Create\CreatePlaceCommand;
use App\Product\Place\Application\SearchByCriteria\SearchPlaceByCriteriaQuery;
use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceName;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;

final class SavePlaceService
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly QueryBus $queryBus
    )
    {

    }
    public function savePlace(string $name): string
    {
        $result = $this->queryBus->ask(SearchPlaceByCriteriaQuery::create('name', $name));

        if (!is_null($result)){
            return $result['id'];
        }

        $placeId = Uuid::random()->value();

        $this->commandBus->dispatch(
            CreatePlaceCommand::create(
                new PlaceId($placeId),
                new PlaceName($name)
            )

        );

        return $placeId;
    }
}