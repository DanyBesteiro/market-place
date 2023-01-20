<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\SearchByCriteria;

use \App\Shared\Domain\Bus\Query\Query;

final class SearchTrolleyByCriteriaQuery implements Query
{
    public function __construct(public readonly array $criteria)
    {
    }

    public static function create(array $criteria): self
    {
        return new self($criteria);
    }
}