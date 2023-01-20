<?php

declare(strict_types=1);

namespace Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Shipment extends AggregateRoot
{
    public function __construct(
        private ShipmentId $id,
        private ShipmentPersonAddressId $personAddressId,
        private ShipmentState $state,
        private ShipmentTrolleyId $trolleyId,
    )
    {
    }

    public static function create(
        ShipmentId $id,
        ShipmentPersonAddressId $personAddressId,
        ShipmentState $state,
        ShipmentTrolleyId $trolleyId,
    ): self {
        return new self(
            $id,
            $personAddressId,
            $state,
            $trolleyId,
        );
    }

    public function id(): ShipmentId
    {
        return $this->id;
    }

    public function personAddressId(): ShipmentPersonAddressId
    {
        return $this->personAddressId;
    }

    public function state(): ShipmentState
    {
        return $this->state;
    }

    public function trolleyId(): ShipmentTrolleyId
    {
        return $this->trolleyId;
    }
}