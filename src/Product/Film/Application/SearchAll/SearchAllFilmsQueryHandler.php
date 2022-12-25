<?php

namespace App\Product\Film\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllFilmsQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllFilmsSearcher $searcher)
    {

    }

    public function __invoke(SearchAllFilmsQuery $query): array
    {
        return $this->searcher->execute();
    }
}