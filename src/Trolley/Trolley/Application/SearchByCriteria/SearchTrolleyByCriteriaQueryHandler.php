<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\SearchByCriteria;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchTrolleyByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly TrolleyByCriteriaSearcher $personByCriteriaSearcher)
    {

    }

    public function __invoke(SearchTrolleyByCriteriaQuery $query): ?array
    {
        return $this->personByCriteriaSearcher->execute($query->criteria);
    }
}