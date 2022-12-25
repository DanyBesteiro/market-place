<?php

declare(strict_types=1);

namespace App\Product\Producer\Domain;

use App\Shared\Domain\Aggregate\AggregateRoot;

final class Producer extends AggregateRoot
{
    public function __construct( private readonly ProducerId $id, private readonly ProducerName $name)
    {
    }

    public static function create(ProducerId $id, ProducerName $name): self
    {
        return new self($id, $name);
    }

    public function id(): ProducerId
    {
        return $this->id;
    }

    public function name(): ProducerName
    {
        return $this->name;
    }
}
