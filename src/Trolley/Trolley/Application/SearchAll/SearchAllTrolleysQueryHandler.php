<?php

declare(strict_types=1);

namespace App\Trolley\Trolley\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllTrolleysQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllTrolleysSearcher $searcher)
    {

    }

    public function __invoke(SearchAllTrolleysQuery $query): array
    {
        return $this->searcher->execute();
    }

}