<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;
use App\Trolley\Trolley\Application\DomainEvent\TrolleyHadBeenFinalizedDomainEvent;

final class Trolley extends AggregateRoot
{
    public function __construct(
        private TrolleyId $id,
        private TrolleyPersonId $personId,
        private TrolleyState $state
    )
    {
    }

    public static function create(
        TrolleyId $id,
        TrolleyPersonId $personId,
        TrolleyState $stateId
    ): self {
        return new self(
            $id,
            $personId,
            $stateId
        );
    }

    public function id(): TrolleyId
    {
        return $this->id;
    }

    public function personId(): TrolleyPersonId
    {
        return $this->personId;
    }

    public function state(): TrolleyState
    {
        return $this->state;
    }

    public function finalizeTrolleyState(string $addressId): void
    {
        $this->updateState(
            new TrolleyState(TrolleyStates::Finalized->value)
        );

        $this->record(
            new TrolleyHadBeenFinalizedDomainEvent(
                $addressId,
                $this->id->value()
            )
        );
    }

    public function updateState(TrolleyState $trolleyState): void
    {
        $this->state = $trolleyState;
    }
}