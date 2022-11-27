<?php

declare(strict_types=1);

namespace App\Film\Application\SearchById;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchFilmByIdQueryHandler implements QueryHandler
{
    public function __construct(private readonly FilmByIdSearcher $filmByIdSearcher)
    {

    }

    public function __invoke(SearchFilmByIdQuery $query): array
    {
        return $this->filmByIdSearcher->execute($query->id);
    }
}