<?php

declare(strict_types=1);

namespace App\Person\Person\Application\Create;

use App\Person\Person\Domain\PersonCif;
use App\Person\Person\Domain\PersonId;
use App\Person\Person\Domain\PersonName;
use App\Person\Person\Domain\PersonTypeId;

use App\Shared\Domain\Bus\Command\Command;

final class CreatePersonCommand implements Command
{
    public function __construct(
        public readonly PersonId $id,
        public readonly PersonCif $cif,
        public readonly PersonName $name,
        public readonly PersonTypeId $typeId,
    ) {
    }

    public static function create(
        PersonId $id,
        PersonCif $cif,
        PersonName $name,
        PersonTypeId $typeId,
    ): self {
        return new self(
            $id,
            $cif,
            $name,
            $typeId,
        );
    }
}