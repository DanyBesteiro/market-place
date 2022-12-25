<?php

declare(strict_types=1);

namespace App\Product\Producer\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreateProducerCommandHandler implements CommandHandler
{
    public function __construct(private readonly ProducerCreator $creator)
    {
    }

    public function __invoke(CreateProducerCommand $command): void
    {
        $this->creator->execute($command->id, $command->name);
    }
}