<?php

namespace App\Product\Producer\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllProducersQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllProducersSearcher $searcher)
    {

    }

    public function __invoke(SearchAllProducersQuery $query): array
    {
        return $this->searcher->execute();
    }
}