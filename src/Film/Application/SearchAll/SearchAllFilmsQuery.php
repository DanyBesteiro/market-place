<?php

namespace App\Film\Application\SearchAll;

use App\Shared\Domain\Bus\Query\Query;

final class SearchAllFilmsQuery implements Query
{
    public static function create(): self
    {
        return new self();
    }

    public function __construct()
    {
    }
}