<?php

declare(strict_types=1);

namespace App\Trolley\Shipment\Application\Create;

use Domain\Shipment;
use Domain\ShipmentId;
use Domain\ShipmentPersonAddressId;
use Domain\ShipmentRepository;
use Domain\ShipmentState;
use Domain\ShipmentTrolleyId;

final class ShipmentCreator
{
    public function __construct(private readonly ShipmentRepository $shipmentRepository)
    {

    }

    public function execute(
        ShipmentId $id,
        ShipmentPersonAddressId $personAddressId,
        ShipmentState $state,
        ShipmentTrolleyId $trolleyId,
    ): void {
        $this->shipmentRepository->save(
            Shipment::create(
                $id,
                $personAddressId,
                $state,
                $trolleyId
            )
        );
    }
}