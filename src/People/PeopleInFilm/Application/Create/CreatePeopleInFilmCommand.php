<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Application\Create;

use App\People\PeopleInFilm\Domain\PeopleInFilmFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmParticipationTypeId;
use App\People\PeopleInFilm\Domain\PeopleInFilmPersonId;
use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmTitle;
use App\Shared\Domain\Bus\Command\Command;

final class CreatePeopleInFilmCommand implements Command
{
    public function __construct(
        public readonly PeopleInFilmId $id,
        public readonly PeopleInFilmFilmId $filmId,
        public readonly PeopleInFilmPersonId $personId,
        public readonly PeopleInFilmParticipationTypeId $participationTypeId
    ) {
    }

    public static function create(
        PeopleInFilmId $id,
        PeopleInFilmFilmId $filmId,
        PeopleInFilmPersonId $personId,
        PeopleInFilmParticipationTypeId $participationTypeId
    ): self {
        return new self(
            $id,
            $filmId,
            $personId,
            $participationTypeId
        );
    }
}