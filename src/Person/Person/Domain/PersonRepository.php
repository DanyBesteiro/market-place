<?php

declare(strict_types=1);

namespace App\Person\Person\Domain;

interface PersonRepository
{
    public function save(Person $person): void;

    public function search(PersonId $id): array;

    public function searchByCriteria(string $criteriaName, string $criteriaValue): ?array;

    public function searchAll(): array;
}
