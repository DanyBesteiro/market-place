<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Domain;


enum TrolleyStates: string
{
    case Active = 'active';
    case Finalized = 'finalized';
    case Received = 'received';
}