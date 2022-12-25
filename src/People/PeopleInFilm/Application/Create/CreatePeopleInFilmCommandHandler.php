<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Application\Create;

use App\Product\Film\Application\Create\CreateFilmCommand;
use App\Product\Film\Application\Create\FilmCreator;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePeopleInFilmCommandHandler implements CommandHandler
{
    public function __construct(private readonly PeopleInFilmCreator $creator)
    {
    }

    public function __invoke(CreatePeopleInFilmCommand $command): void
    {
        $this->creator->execute(
            $command->id,
            $command->filmId,
            $command->personId,
            $command->participationTypeId,
        );
    }
}