<?php

declare(strict_types=1);

namespace App\Command\DataLoaderCommandServices;

use App\People\ParticipationType\Domain\ParticipationType;
use App\People\PeopleInFilm\Application\Create\CreatePeopleInFilmCommand;
use App\People\PeopleInFilm\Domain\PeopleInFilmFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmId;
use App\People\PeopleInFilm\Domain\PeopleInFilmParticipationTypeId;
use App\People\PeopleInFilm\Domain\PeopleInFilmPersonId;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;

final class SavePeopleInFilmService
{
    public function __construct(private readonly CommandBus $commandBus)
    {

    }

    public function savePeopleInFilms(
        array $actors,
        array $directors,
        array $writers,
        string $filmId,
    ): void {
        foreach ($directors as $director) {
            $this->insertParticipation(
                $filmId,
                $director,
                ParticipationType::DIRECTOR_UUID
            );
        }

        foreach ($actors as $actor) {
            $this->insertParticipation(
                $filmId,
                $actor,
                ParticipationType::ACTOR_UUID
            );
        }

        foreach ($writers as $writer) {
            $this->insertParticipation(
                $filmId,
                $writer,
                ParticipationType::WRITER_UUID
            );
        }
    }

    private function insertParticipation(
        string $film,
        string $person,
        string $participation
    ): void
    {
        $this->commandBus->dispatch(
            CreatePeopleInFilmCommand::create(
                new PeopleInFilmId(Uuid::random()->value()),
                new PeopleInFilmFilmId($film),
                new PeopleInFilmPersonId($person),
                new PeopleInFilmParticipationTypeId($participation)
            )
        );
    }
}