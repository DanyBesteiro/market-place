<?php

declare(strict_types=1);

namespace App\Controller\Person;

use App\Shared\Domain\Bus\Query\QueryBus;
use App\Trolley\Trolley\Application\SearchByCriteria\SearchTrolleyByCriteriaQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class TrolleysByPersonGetController extends AbstractController
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    public function __invoke(string $personId): JsonResponse
    {
        return new JsonResponse(
            $this->queryBus->ask(query:
                new SearchTrolleyByCriteriaQuery(['personId' => $personId])
            )
        );
    }
}