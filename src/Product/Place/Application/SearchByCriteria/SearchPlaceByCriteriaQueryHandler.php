<?php

namespace App\Product\Place\Application\SearchByCriteria;

use App\Product\Producer\Application\SearchAll\AllProducersSearcher;
use App\Product\Producer\Application\SearchAll\SearchAllProducersQuery;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchPlaceByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly PlaceByCriteriaSearcher $searcher)
    {

    }

    public function __invoke(SearchPlaceByCriteriaQuery $query): ?array
    {
        return $this->searcher->execute($query->criteriaKey, $query->criteriaValue);
    }
}