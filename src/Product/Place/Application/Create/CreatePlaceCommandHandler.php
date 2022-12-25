<?php

declare(strict_types=1);

namespace App\Product\Place\Application\Create;

use App\Product\Producer\Application\Create\CreateProducerCommand;
use App\Product\Producer\Application\Create\ProducerCreator;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreatePlaceCommandHandler implements CommandHandler
{
    public function __construct(private readonly PlaceCreator $creator)
    {
    }

    public function __invoke(CreatePlaceCommand $command): void
    {
        $this->creator->execute($command->id, $command->name);
    }
}