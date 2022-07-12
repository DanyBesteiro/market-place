<?php

namespace App\UseCases\Search\Films;

use App\Repository\FilmRepository;

final class SearchFilmsByName
{
    public function __construct(
        private readonly FilmRepository $filmRepository
    ) {

    }

    public function execute (string $name): array
    {
        $out    = [];
        $films  = $this->filmRepository->findByName(value: $name);

        foreach($films as $film){
            $out['films'][] = $film->getId() . '-' . $film->getTitle();
        }

        return $out;
    }
}