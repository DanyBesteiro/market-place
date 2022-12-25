<?php

declare(strict_types=1);

namespace App\Product\Place\Application\SearchByCriteria;

use App\Product\Place\Domain\PlaceRepository;

final class PlaceByCriteriaSearcher
{
    public function __construct(private readonly PlaceRepository $repository)
    {

    }

    public function execute(string $criteriaName, string $criteriaValue): ?array
    {
        return $this->repository->searchByCriteria($criteriaName, $criteriaValue);
    }
}