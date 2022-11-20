<?php

namespace App\Film\Application\SearchById;

use App\Film\Domain\Film;
use App\Film\Domain\FilmId;
use App\Film\Domain\FilmRepository;

final class FilmByIdSearcher
{
    public function __construct(private readonly FilmRepository $filmRepository)
    {

    }

    public function execute(string $id): Film
    {
        return $this->filmRepository->search(new FilmId($id));
    }
}