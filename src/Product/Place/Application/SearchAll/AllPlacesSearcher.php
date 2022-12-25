<?php

declare(strict_types=1);

namespace App\Product\Place\Application\SearchAll;

use App\Product\Place\Domain\PlaceRepository;

final class AllPlacesSearcher
{
    public function __construct(private readonly PlaceRepository $placeRepository)
    {

    }

    public function execute(): array
    {
        return $this->placeRepository->searchAll();
    }
}