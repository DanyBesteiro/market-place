<?php

declare(strict_types=1);

namespace App\People\Person\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Person extends AggregateRoot
{
    public function __construct(
        private readonly PersonId $id,
        private readonly PersonBirthDate $birthDate,
        private readonly PersonDeathDate $deathDate,
        private readonly PersonName $name
    )
    {
    }

    public static function create(
        PersonId $id,
        PersonBirthDate $birthDate,
        PersonDeathDate $deathDate,
        PersonName $name,
    ): self {
        return new self(
            $id,
            $birthDate,
            $deathDate,
            $name
        );
    }

    public function id(): PersonId
    {
        return $this->id;
    }

    public function birthDate(): PersonBirthDate
    {
        return $this->birthDate;
    }

    public function deathDate(): PersonDeathDate
    {
        return $this->deathDate;
    }

    public function name(): PersonName
    {
        return $this->name;
    }
}