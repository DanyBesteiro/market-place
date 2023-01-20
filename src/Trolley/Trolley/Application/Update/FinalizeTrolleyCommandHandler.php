<?php

namespace App\Trolley\Trolley\Application\Update;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Trolley\Trolley\Domain\TrolleyId;
use App\Trolley\Trolley\Domain\TrolleyRepository;

final class FinalizeTrolleyCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly TrolleyRepository $trolleyRepository
    )
    {
    }

    public function __invoke(FinalizeTrolleyCommand $command): void
    {
        $trolley = $this->trolleyRepository->find(new TrolleyId($command->trolleyId));

        $trolley->finalizeTrolleyState($command->addressId);

        $this->trolleyRepository->save($trolley);
    }
}