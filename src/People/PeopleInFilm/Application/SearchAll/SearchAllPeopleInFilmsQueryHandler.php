<?php

declare(strict_types=1);

namespace App\People\PeopleInFilm\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllPeopleInFilmsQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllPeopleInFilmsSearcher $searcher)
    {

    }

    public function __invoke(SearchAllPeopleInFilmsQuery $query): array
    {
        return $this->searcher->execute();
    }

}