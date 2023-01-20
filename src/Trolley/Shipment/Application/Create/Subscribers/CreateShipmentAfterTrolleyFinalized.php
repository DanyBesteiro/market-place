<?php

namespace App\Trolley\Shipment\Application\Create\Subscribers;

use App\Shared\Domain\Bus\Event\DomainEventSubscriber;
use App\Shared\Domain\ValueObject\Uuid;
use App\Trolley\Shipment\Application\Create\ShipmentCreator;
use App\Trolley\Trolley\Application\DomainEvent\TrolleyHadBeenFinalizedDomainEvent;
use Domain\ShipmentId;
use Domain\ShipmentPersonAddressId;
use Domain\ShipmentState;
use Domain\ShipmentStates;
use Domain\ShipmentTrolleyId;

final class CreateShipmentAfterTrolleyFinalized implements DomainEventSubscriber
{
    public function __construct(private readonly ShipmentCreator $shipmentCreator)
    {

    }

    public function __invoke(TrolleyHadBeenFinalizedDomainEvent $event): void
    {
        $this->shipmentCreator->execute(
            new ShipmentId(Uuid::random()),
            new ShipmentPersonAddressId($event->addressId),
            new ShipmentState(ShipmentStates::Active->value),
            new ShipmentTrolleyId($event->trolleyId),
        );
    }
}