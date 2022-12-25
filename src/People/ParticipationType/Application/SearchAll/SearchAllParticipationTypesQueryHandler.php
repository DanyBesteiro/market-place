<?php

declare(strict_types=1);

namespace App\People\ParticipationType\Application\SearchAll;

use App\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllParticipationTypesQueryHandler implements QueryHandler
{
    public function __construct(private readonly AllParticipationTypesSearcher $searcher)
    {

    }

    public function __invoke(SearchAllParticipationTypesQuery $query): array
    {
        return $this->searcher->execute();
    }

}