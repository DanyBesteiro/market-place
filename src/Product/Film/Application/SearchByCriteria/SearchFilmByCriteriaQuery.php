<?php

declare(strict_types=1);

namespace App\Product\Film\Application\SearchByCriteria;

use \App\Shared\Domain\Bus\Query\Query;

final class SearchFilmByCriteriaQuery implements Query
{
    public function __construct(public readonly string $criteria, public readonly string $value)
    {
    }

    public function create(string $criteria,string $value): self
    {
        return new self ($criteria, $value);
    }
}