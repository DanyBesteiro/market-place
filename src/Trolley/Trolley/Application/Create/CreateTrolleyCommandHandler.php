<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Trolley\Trolley\Application\SearchByCriteria\SearchTrolleyByCriteriaQuery;
use App\Trolley\Trolley\Domain\TrolleyStates;

final class CreateTrolleyCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly TrolleyCreator $creator
    )
    {
    }

    public function __invoke(CreateTrolleyCommand $command): void
    {
        if ($this->personComplyWithTheTrolleyConditions($command->personId->value())) {
            $this->creator->execute(
                $command->id,
                $command->personId,
                $command->stateId,
            );
        } else {
            throw new \Exception('This person already have an active trolley');
        }
    }


    private function personComplyWithTheTrolleyConditions(string $personId): bool
    {
        $activeTrolleys = $this->queryBus->ask(
            SearchTrolleyByCriteriaQuery::create([
                'state' => TrolleyStates::Active->value,
                'personId' => $personId
            ])
        );

        return is_null($activeTrolleys);
    }
}