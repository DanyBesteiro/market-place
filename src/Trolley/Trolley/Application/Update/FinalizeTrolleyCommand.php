<?php

namespace App\Trolley\Trolley\Application\Update;

use App\Shared\Domain\Bus\Command\Command;

final class FinalizeTrolleyCommand implements Command
{
    public function __construct(
        public readonly string $addressId,
        public readonly string $trolleyId
    ) {

    }

    public static function create(string $addressId, string $trolleyId): self
    {
        return new self($addressId, $trolleyId);
    }
}