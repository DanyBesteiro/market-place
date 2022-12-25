<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Application\SearchAll;

use App\People\PeopleInFilm\Domain\PeopleInFilmRepository;

final class AllPeopleInFilmsSearcher
{
    public function __construct(private readonly PeopleInFilmRepository $peopleInFilmRepository)
    {

    }

    public function execute(): array
    {
        return $this->peopleInFilmRepository->searchAll();
    }
}