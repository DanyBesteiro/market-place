<?php

declare(strict_types=1);

namespace Domain;
enum ShipmentStates: string
{
    case Active = 'active';
    case Finalized = 'finalized';
    case Received = 'received';
}