<?php

declare(strict_types=1);

namespace App\Product\Film\Application\SearchByCriteria;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchFilmByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly FilmByCriteriaSearcher $filmByCriteriaSearcher)
    {

    }

    public function __invoke(SearchFilmByCriteriaQuery $query): array
    {
        return $this->filmByCriteriaSearcher->execute($query->criteria, $query->value);
    }
}