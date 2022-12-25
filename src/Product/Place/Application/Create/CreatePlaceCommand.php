<?php

declare(strict_types=1);

namespace App\Product\Place\Application\Create;

use App\Product\Place\Domain\PlaceId;
use App\Product\Place\Domain\PlaceName;
use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\ProducerName;
use App\Shared\Domain\Bus\Command\Command;

final class CreatePlaceCommand implements Command
{
    public function __construct(
        public readonly PlaceId $id,
        public readonly PlaceName $name
    ) {
    }

    public static function create(
        PlaceId $id,
        PlaceName $name
    ): self {
        return new self($id, $name);
    }
}