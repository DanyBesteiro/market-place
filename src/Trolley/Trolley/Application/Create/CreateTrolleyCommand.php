<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\Create;

use App\Shared\Domain\Bus\Command\Command;
use App\Trolley\Trolley\Domain\TrolleyId;
use App\Trolley\Trolley\Domain\TrolleyPersonId;
use App\Trolley\Trolley\Domain\TrolleyState;

final class CreateTrolleyCommand implements Command
{
    public function __construct(
        public readonly TrolleyId       $id,
        public readonly TrolleyPersonId $personId,
        public readonly TrolleyState    $stateId,
    ) {
    }

    public static function create(
        TrolleyId       $id,
        TrolleyPersonId $personId,
        TrolleyState    $stateId,
    ): self {
        return new self(
            $id,
            $personId,
            $stateId,
        );
    }
}