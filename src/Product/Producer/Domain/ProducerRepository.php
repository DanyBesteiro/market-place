<?php

declare(strict_types=1);

namespace App\Product\Producer\Domain;

interface ProducerRepository
{
    public function save(Producer $producer): void;

    public function search(ProducerId $id): array;

    public function searchByCriteria(string $criteriaName, string $criteriaValue): ?array;

    public function searchAll(): array;
}
