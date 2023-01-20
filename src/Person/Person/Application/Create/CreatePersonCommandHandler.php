<?php

declare(strict_types=1);

namespace App\Person\Person\Application\Create;

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
            $command->cif,
            $command->name,
            $command->typeId,
        );
    }
}