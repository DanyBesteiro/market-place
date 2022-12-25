<?php

declare(strict_types=1);

namespace App\Product\Place\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Place extends AggregateRoot
{
    public function __construct(
        private readonly PlaceId $id,
        private readonly PlaceName $name
    )
    {
    }

    public static function create(
        PlaceId $id,
        PlaceName $name
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): PlaceId
    {
        return $this->id;
    }

    public function name(): PlaceName
    {
        return $this->name;
    }
}