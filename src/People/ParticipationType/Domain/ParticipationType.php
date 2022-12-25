<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class ParticipationType extends AggregateRoot
{
    public const ACTOR_UUID = 'ff480fdb-48b3-4707-8db2-3b24e247fffd';
    public const DIRECTOR_UUID = 'e02c92f8-b4eb-4603-92ff-60ef7058e104';
    public const WRITER_UUID = '0055ff7d-6dcb-4eb4-bc4e-0a56169bda7a';
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