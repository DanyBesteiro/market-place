<?php

declare(strict_types=1);

namespace SearchByCriteria;

use App\Shared\Domain\Bus\Query\QueryHandler;
use App\Trolley\Trolley\Application\SearchByCriteria\SearchTrolleyByCriteriaQuery;
use App\Trolley\Trolley\Application\SearchByCriteria\TrolleyByCriteriaSearcher;

final class SearchArticleInTrolleyByCriteriaQueryHandler implements QueryHandler
{
    public function __construct(private readonly ArticleInTrolleyByCriteriaSearcher $personByCriteriaSearcher)
    {

    }

    public function __invoke(SearchArticleInTrolleyByCriteriaQuery $query): ?array
    {
        return $this->personByCriteriaSearcher->execute($query->criteria);
    }
}