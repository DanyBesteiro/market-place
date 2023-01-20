<?php

declare(strict_types=1);

namespace App\Controller\Person;

use App\Person\Person\Application\SearchAll\SearchAllPersonsQuery;
use App\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AllPersonsGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            data: $this->queryBus->ask(query:  new  SearchAllPersonsQuery())
        );
    }
}