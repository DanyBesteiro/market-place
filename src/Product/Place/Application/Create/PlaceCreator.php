<?php

declare(strict_types=1);

namespace App\Product\Place\Application\Create;

use App\Product\Place\Domain\Place;
use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceName;
use App\Product\Place\Domain\PlaceRepository;

final class PlaceCreator
{
    public function __construct(private readonly PlaceRepository $placeRepository)
    {

    }

    public function execute(PlaceId $id, PlaceName $name): void
    {
        $this->placeRepository->save(Place::create($id, $name));
    }
}