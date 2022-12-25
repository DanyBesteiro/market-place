<?php

declare(strict_types=1);

namespace App\People\Person\Application\SearchByCriteria;

use App\Product\Film\Application\SearchByCriteria\FilmByCriteriaSearcher;
use App\Product\Film\Application\SearchByCriteria\SearchFilmByCriteriaQuery;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchPersonByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly PersonByCriteriaSearcher $personByCriteriaSearcher)
    {

    }

    public function __invoke(SearchPersonByCriteriaQuery $query): ?array
    {
        return $this->personByCriteriaSearcher->execute($query->criteriaKey, $query->criteriaValue);
    }
}