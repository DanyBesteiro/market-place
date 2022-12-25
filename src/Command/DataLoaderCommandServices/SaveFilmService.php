<?php

declare(strict_types=1);

namespace App\Command\DataLoaderCommandServices;

use App\Product\Film\Application\Create\CreateFilmCommand;
use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmTitle;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;

final class SaveFilmService
{
    public function __construct(private readonly CommandBus $commandBus)
    {

    }

    public function saveFilm(
        array $film,
        string $placeId,
        string $producerId,
    ): string {

        $filmId = Uuid::random()->value();

        $this->commandBus->dispatch(
            CreateFilmCommand::create(
                new FilmId($filmId),
                new FilmDate(false === $film['date'] ? null : $film['date']),
                new FilmDuration($film['duration']),
                new FilmPlace($placeId),
                new FilmProducer($producerId),
                new FilmTitle($film['title'])
            )
        );

        return $filmId;
    }
}