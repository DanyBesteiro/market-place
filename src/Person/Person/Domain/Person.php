<?php

declare(strict_types=1);

namespace App\Person\Person\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Person extends AggregateRoot
{
    public function __construct(
        private PersonId $id,
        private PersonCif $cif,
        private PersonName $name,
        private PersonTypeId $typeId
    )
    {
    }

    public static function create(
        PersonId $id,
        PersonCif $cif,
        PersonName $name,
        PersonTypeId $typeId
    ): self {
        return new self(
            $id,
            $cif,
            $name,
            $typeId
        );
    }

    public function id(): PersonId
    {
        return $this->id;
    }

    public function cif(): PersonCif
    {
        return $this->cif;
    }

    public function name(): PersonName
    {
        return $this->name;
    }

    public function typeId(): PersonTypeId
    {
        return $this->typeId;
    }
}