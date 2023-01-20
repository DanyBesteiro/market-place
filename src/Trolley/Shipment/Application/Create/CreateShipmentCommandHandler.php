<?php

declare(strict_types=1);

namespace App\Trolley\Shipment\Application\Create;

use App\Shared\Domain\Bus\Command\CommandHandler;

final class CreateShipmentCommandHandler implements CommandHandler
{
    public function __construct(public readonly ShipmentCreator $shipmentCreator)
    {

    }

    public function __invoke(CreateShipmentCommand $command): void
    {
        $this->shipmentCreator->execute(
            $command->id,
            $command->personAddressId,
            $command->state,
            $command->trolleyId
        );
    }
}