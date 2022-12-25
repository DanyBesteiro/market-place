<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class ParticipationType extends AggregateRoot
{
    public function __construct(
        private readonly ParticipationTypeId $id,
        private readonly ParticipationTypeName $name
    )
    {
    }

    public static function create(
        ParticipationTypeId $id,
        ParticipationTypeName $name
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): ParticipationTypeId
    {
        return $this->id;
    }

    public function name(): ParticipationTypeName
    {
        return $this->name;
    }
}