<?php

declare(strict_types=1);

namespace App\Person\Person\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllPersonsQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllPersonsSearcher $searcher)
    {

    }

    public function __invoke(SearchAllPersonsQuery $query): array
    {
        return $this->searcher->execute();
    }

}