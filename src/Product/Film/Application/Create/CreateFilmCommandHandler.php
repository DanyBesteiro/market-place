<?php

declare(strict_types=1);

namespace App\Product\Film\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreateFilmCommandHandler implements CommandHandler
{
    public function __construct(private readonly FilmCreator $creator)
    {
    }

    public function __invoke(CreateFilmCommand $command): void
    {
        $this->creator->execute(
            $command->id,
            $command->date,
            $command->duration,
            $command->place,
            $command->producer,
            $command->title
        );
    }
}