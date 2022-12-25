<?php

namespace App\Product\Producer\Application\SearchByCriteria;

use App\Product\Producer\Application\SearchAll\AllProducersSearcher;
use App\Product\Producer\Application\SearchAll\SearchAllProducersQuery;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchProducerByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly ProducerByCriteriaSearcher $searcher)
    {

    }

    public function __invoke(SearchProducerByCriteriaQuery $query): ?array
    {
        return $this->searcher->execute($query->criteriaKey, $query->criteriaValue);
    }
}