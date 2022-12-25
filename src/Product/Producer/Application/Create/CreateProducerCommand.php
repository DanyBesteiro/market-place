<?php

declare(strict_types=1);

namespace App\Product\Producer\Application\Create;

use App\Product\Producer\Domain\ProducerId;
use App\Product\Producer\Domain\ProducerName;
use App\Shared\Domain\Bus\Command\Command;

final class CreateProducerCommand implements Command
{
    public function __construct(
        public readonly ProducerId $id,
        public readonly ProducerName $name
    ) {
    }

    public static function create(
        ProducerId $id,
        ProducerName $name
    ): self {
        return new self($id, $name);
    }
}