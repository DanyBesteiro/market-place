<?php

declare(strict_types=1);

namespace App\Film\Application\SearchById;

use \App\Shared\Domain\Bus\Query\Query;

final class SearchFilmByIdQuery implements Query
{
    public function __construct(public readonly string $id)
    {
    }

    public function create(string $id): self
    {
        return new self ($id);
    }
}