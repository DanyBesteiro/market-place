<?php

namespace App\Film\Application\SearchById;

use App\Film\Domain\Film;
use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchFilmByIdQueryHandler implements QueryHandler
{
    public function __construct(private readonly FilmByIdSearcher $searcher)
    {

    }

    public function __invoke(SearchFilmByIdQuery $query): Film
    {
        return $this->searcher->execute('5');
    }
}