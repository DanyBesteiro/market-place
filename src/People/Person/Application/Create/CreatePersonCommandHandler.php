<?php

declare(strict_types=1);

namespace App\People\Person\Application\Create;

use App\Product\Film\Application\Create\CreateFilmCommand;
use App\Product\Film\Application\Create\FilmCreator;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePersonCommandHandler implements CommandHandler
{
    public function __construct(private readonly PersonCreator $creator)
    {
    }

    public function __invoke(CreatePersonCommand $command): void
    {
        $this->creator->execute(
            $command->id,
            $command->birthDate,
            $command->deathDate,
            $command->name,
        );
    }
}