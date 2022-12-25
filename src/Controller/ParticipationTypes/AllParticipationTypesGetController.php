<?php

declare(strict_types=1);

namespace App\Controller\ParticipationTypes;

use App\People\ParticipationType\Application\SearchAll\SearchAllParticipationTypesQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllParticipationTypesGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            data: $this->queryBus->ask(query:  new SearchAllParticipationTypesQuery())
        );
    }
}