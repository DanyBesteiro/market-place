<?php

declare(strict_types=1);

namespace App\Product\Place\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllPlacesQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllPlacesSearcher $searcher)
    {

    }

    public function __invoke(SearchAllPlacesQuery $query): array
    {
        return $this->searcher->execute();
    }
}