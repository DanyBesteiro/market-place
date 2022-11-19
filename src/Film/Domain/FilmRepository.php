<?php

declare(strict_types=1);

namespace App\Film\Domain;

interface FilmRepository
{

    public function save(Film $film): void;

    public function search(FilmId $id): ?Film;
}
