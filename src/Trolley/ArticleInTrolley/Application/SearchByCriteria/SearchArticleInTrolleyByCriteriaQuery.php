<?php

declare(strict_types=1);

namespace SearchByCriteria;

use \App\Shared\Domain\Bus\Query\Query;

final class SearchArticleInTrolleyByCriteriaQuery implements Query
{
    public function __construct(public readonly array $criteria)
    {
    }

    public static function create(array $criteria): self
    {
        return new self($criteria);
    }
}