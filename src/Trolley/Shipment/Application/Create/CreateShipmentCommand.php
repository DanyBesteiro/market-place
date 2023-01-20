<?php

declare(strict_types=1);

namespace App\Trolley\Shipment\Application\Create;

use App\Shared\Domain\Bus\Command\Command;
use Domain\ShipmentId;
use Domain\ShipmentPersonAddressId;
use Domain\ShipmentState;
use Domain\ShipmentTrolleyId;

final class CreateShipmentCommand implements Command
{
    public function __construct(
        public readonly ShipmentId $id,
        public readonly ShipmentPersonAddressId $personAddressId,
        public readonly ShipmentState $state,
        public readonly ShipmentTrolleyId $trolleyId,
    ) {

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
            $trolleyId
        );
    }
}