<?php

declare(strict_types=1);

namespace App\People\Person\Application\Create;

use App\People\Person\Domain\PersonBirthDate;
use App\People\Person\Domain\PersonDeathDate;
use App\People\Person\Domain\PersonId;
use App\People\Person\Domain\PersonName;
use App\Product\Film\Domain\FilmDate;
use App\Product\Film\Domain\FilmDuration;
use App\Product\Film\Domain\FilmId;
use App\Product\Film\Domain\FilmPlace;
use App\Product\Film\Domain\FilmProducer;
use App\Product\Film\Domain\FilmTitle;
use App\Shared\Domain\Bus\Command\Command;

final class CreatePersonCommand implements Command
{
    public function __construct(
        public readonly PersonId $id,
        public readonly PersonBirthDate $birthDate,
        public readonly PersonDeathDate $deathDate,
        public readonly PersonName $name
    ) {
    }

    public static function create(
        PersonId $id,
        PersonBirthDate $birthDate,
        PersonDeathDate $deathDate,
        PersonName $name
    ): self {
        return new self(
            $id,
            $birthDate,
            $deathDate,
            $name
        );
    }
}