<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class PeopleInFilm extends AggregateRoot
{
    public function __construct(
        private readonly PeopleInFilmId $id,
        private readonly PeopleInFilmFilmId $filmId,
        private readonly PeopleInFilmPersonId $personId,
        private readonly PeopleInFilmParticipationTypeId $participationTypeId
    )
    {
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

    public function id(): PeopleInFilmId
    {
        return $this->id;
    }

    public function filmId(): PeopleInFilmFilmId
    {
        return $this->filmId;
    }

    public function personId(): PeopleInFilmPersonId
    {
        return $this->personId;
    }

    public function gparticipationTypeId(): PeopleInFilmParticipationTypeId
    {
        return $this->participationTypeId;
    }
}