<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Application\Create;

use App\People\PeopleInFilm\Domain\PeopleInFilm;
use App\People\PeopleInFilm\Domain\PeopleInFilmFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmParticipationTypeId;
use App\People\PeopleInFilm\Domain\PeopleInFilmPersonId;
use App\People\PeopleInFilm\Domain\PeopleInFilmRepository;
use App\Product\Film\Domain\Film;
use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmRepository;
use App\Product\Film\Domain\FilmTitle;
use App\Product\Place\Domain\Place;
use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceName;
use App\Product\Place\Domain\PlaceRepository;

final class PeopleInFilmCreator
{
    public function __construct(private readonly PeopleInFilmRepository $peopleInFilmRepository)
    {

    }

    public function execute(
        PeopleInFilmId $id,
        PeopleInFilmFilmId $filmId,
        PeopleInFilmPersonId $personId,
        PeopleInFilmParticipationTypeId $participationTypeId
    ): void {
        $this->peopleInFilmRepository->save(
            PeopleInFilm::create(
                id: $id,
                filmId: $filmId,
                personId: $personId,
                participationTypeId: $participationTypeId
            )
        );
    }
}