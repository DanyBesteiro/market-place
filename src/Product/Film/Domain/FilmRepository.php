<?php

declare(strict_types=1);

namespace App\Product\Film\Domain;

interface FilmRepository
{
    public function save(Film $film): void;

    public function search(FilmId $id): array;

    public function searchByCriteria(string $criteria, string $value): array;

    public function searchAll(): array;
}
