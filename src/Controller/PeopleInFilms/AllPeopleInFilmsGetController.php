<?php

declare(strict_types=1);

namespace App\Controller\PeopleInFilms;

use App\People\ParticipationType\Application\SearchAll\SearchAllParticipationTypesQuery;
use App\People\PeopleInFilm\Application\SearchAll\SearchAllPeopleInFilmsQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllPeopleInFilmsGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            data: $this->queryBus->ask(query: new SearchAllPeopleInFilmsQuery())
        );
    }
}