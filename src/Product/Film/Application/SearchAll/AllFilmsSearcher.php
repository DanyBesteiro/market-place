<?php

namespace App\Product\Film\Application\SearchAll;

use App\Product\Film\Domain\FilmRepository;

final class AllFilmsSearcher
{
    public function __construct(private readonly FilmRepository $filmRepository)
    {

    }

    public function execute(): array
    {
        return $this->filmRepository->searchAll();
    }
}