<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Domain;

interface PeopleInFilmRepository
{
    public function save(PeopleInFilm $peopleInFilm): void;

    public function search(PeopleInFilmId $id): array;

    public function searchAll(): array;
}
