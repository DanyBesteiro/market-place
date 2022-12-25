<?php

declare(strict_types=1);

namespace App\Controller\Place;

use App\Product\Film\Application\SearchAll\SearchAllFilmsQuery;
use App\People\Person\Application\SearchAll\SearchAllPersonsQuery;
use App\Product\Place\Application\SearchAll\SearchAllPlacesQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllPlacesGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            data: $this->queryBus->ask(query: new SearchAllPlacesQuery())
        );
    }
}