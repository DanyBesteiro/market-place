<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Domain;

interface TrolleyRepository
{
    public function find(TrolleyId $id): Trolley;

    public function save(Trolley $trolley): void;

    public function search(TrolleyId $id): array;

    public function searchByCriteria(array $criteria): ?array;

    public function searchAll(): array;
}
