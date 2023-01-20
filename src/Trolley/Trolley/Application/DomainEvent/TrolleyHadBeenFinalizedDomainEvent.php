<?php

namespace App\Trolley\Trolley\Application\DomainEvent;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class TrolleyHadBeenFinalizedDomainEvent implements DomainEvent
{
    public function __construct(
        public readonly string $addressId,
        public readonly string $trolleyId,
    )
    {
    }
}