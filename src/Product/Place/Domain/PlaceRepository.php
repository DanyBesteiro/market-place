<?php

declare(strict_types=1);

namespace App\Product\Place\Domain;

interface PlaceRepository
{
    public function save(Place $place): void;

    public function search(PlaceId $id): array;

    public function searchByCriteria(string $criteriaKey, string $criteriaValue): ?array;

    public function searchAll(): array;
}
