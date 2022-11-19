<?php

namespace App\Film\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllFilmsQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllFilmsSearcher $searcher)
    {

    }

    public function __invoke(SearchAllFilmsQuery $query): array
    {
        return [
            'searcher' => $this->searcher->execute(),
            'handler' => 'hola desde el handler'
        ];
    }
}